
document.addEventListener("DOMContentLoaded", function () {
  const bottomMenuHeader = document.querySelector(".bottom-menu-header");
  let lastScrollPosition = 0;

  window.addEventListener("scroll", function () {
      const currentScrollPosition = window.scrollY;

      if (currentScrollPosition > lastScrollPosition) {
          // Scrolling down
          bottomMenuHeader.style.transform = "translateY(-100%)";
      } else {
          // Scrolling up
          bottomMenuHeader.style.transform = "translateY(0)";
      }

      lastScrollPosition = currentScrollPosition;
  });
});

//sticky header mobile
document.addEventListener('DOMContentLoaded', function () {
  if (window.innerWidth < 1000) {
      const header = document.querySelector('.mobile-header');
      if (header) {
          document.addEventListener('scroll', function () {
              if (window.scrollY > 0) {
                  header.style.position = 'fixed';
                  header.style.top = '0';
              } else {
                  header.style.position = 'relative';
              }
          });
      }
  }
});

/*document.addEventListener("DOMContentLoaded", function() {
    const menuElement = document.querySelector('.mweb-drop-down');
      if (menuElement) {
      const parentMenu = document.querySelector('.mweb-main-menu ul > li.level-0.mega-menu.menu-has-col.item-dir-vertical');
      const firstChild = parentMenu.querySelector('ul.sub-menu > li:first-child');
      const subMenu = parentMenu.querySelector('ul.sub-menu');
      const otherChildren = subMenu.querySelectorAll('li:not(:first-child)');
  
      let hoveringOtherChild = false;
  
      parentMenu.addEventListener('mouseover', function() {
        if (!hoveringOtherChild) {
          firstChild.classList.add('menu-active');
        }
      });
  
      parentMenu.addEventListener('mouseleave', function() {
        if (!hoveringOtherChild) {
          firstChild.classList.remove('menu-active');
        }
      });
  
      otherChildren.forEach(child => {
        child.addEventListener('mouseover', function() {
          firstChild.classList.remove('menu-active');
          firstChild.classList.add('menu-active-other-child');
          hoveringOtherChild = true;
        });
      });
  
      subMenu.addEventListener('mouseleave', function() {
        if (!subMenu.querySelector('li:hover')) {
          firstChild.classList.add('menu-active');
          firstChild.classList.remove('menu-active-other-child');
          hoveringOtherChild = false;
        }
      });
    }
  });
 */
  document.addEventListener('DOMContentLoaded', function () {
    const searchMobile = document.querySelector('.search-mobile');
    
    // شرط وجود المنت search-mobile
    if (searchMobile) {
        const boxSearchMobile = document.querySelector('.box-search-mobile');
        
        if (boxSearchMobile) {
            // ایجاد دکمه بستن
            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&times;'; // نماد ×
            closeButton.classList.add('close-btn');
            boxSearchMobile.appendChild(closeButton); // اضافه کردن دکمه به div

            // افزودن کلاس active هنگام کلیک روی search-mobile
            searchMobile.addEventListener('click', () => {
                boxSearchMobile.classList.add('active');
            });

            // حذف کلاس active هنگام کلیک روی دکمه بستن
            closeButton.addEventListener('click', () => {
                boxSearchMobile.classList.remove('active');
            });
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".widget-title.with-dropdown").forEach(function (widgetTitle) {
        let widgetContent = widgetTitle.nextElementSibling;
        
        if (widgetContent) {
            widgetContent.style.maxHeight = "0"; // بسته باشد در ابتدا
            widgetContent.style.overflow = "hidden";
            widgetContent.style.transition = "max-height 0.4s ease, opacity 0.4s ease, transform 0.4s ease";
            widgetContent.style.opacity = "0";

            widgetTitle.addEventListener("click", function () {
                let isOpen = this.classList.toggle("open");

                if (isOpen) {
                    widgetContent.style.maxHeight = widgetContent.scrollHeight + "px";
                    widgetContent.style.opacity = "1";
                } else {
                    widgetContent.style.maxHeight = "0";
                    widgetContent.style.opacity = "0";
                }
            });
        }
    });
});
