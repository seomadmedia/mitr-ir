<?php
/*
  Template name: ناحیه کاربری
 */

get_header();


$elm_style = mweb_theme_util::get_theme_option('login_style'); 
?>

<div class="container-wrap page-my-account<?php echo is_user_logged_in() ? '' : ' lr_style_'.$elm_style; ?>">
    <div class="container">
        <div id="content">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
