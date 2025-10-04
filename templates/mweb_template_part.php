<?php

/**
 * render post title
 */
function mweb_post_title( $link = true ) {
	$str = '';
	if($link == true){
		$str .= '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" title="' . esc_attr( get_the_title() ) . '">';
		$str .= get_the_title();
		$str .= '</a>';
	}
	else {
		$str .= get_the_title();
	}
	return $str;
}



/**
 * render post first cat
 */
function mweb_post_first_cat( $name = true ) {
	$category = get_the_category();
	$first_cat = '';
	if (!empty($category)) {
		if($name === true) {
			$first_cat = $category[0]->cat_name;
		} else {
			$first_cat = get_category_link($category[0]->term_id);
	   }
	}

	return $first_cat;
	
}



/**
 * render post format icon
 */
function mweb_post_format_icon() {
	
	$format = get_post_format();
	switch ($format) {
		case "gallery":
			$format = 'image';
			break;
		case "link":
			$format = 'link-1';
			break;
		case "image":
		   $format = 'image';
			break;
		case "quote":
			$format = 'quote-down';
			break;
		case "video":
			$format = 'play';
			break;
		case "audio":
			$format = 'music';
			break;
		default:
			$format = 'book-1';
	}
	return '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'. $format .'"></use></svg>';
	
}



/**
 * render search form categories
 */
function mweb_search_form_categories( $taxonomy = 'category', $has_title = false, $flag = false, $active_category = false ) {

	
	if( !$active_category || $flag )
		return false;
	
	$only_parent = mweb_theme_util::get_theme_option('search_category_level');
	$categories = get_category_list_as_array($taxonomy, $only_parent);
	
	$str = '';
	
	if( !empty($categories) ){
		$str .= '<div class="search_category'. ($has_title == true ? ' has_cat_title' : '') .'">';
			$str .= $has_title == true ? '<span class="btn_search_cat el_cat_title">تمام دسته ها <svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-down"></use></svg></span>' : '<span class="btn_search_cat el_cat_icon"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#setting-4"></use></svg></span>';
			$str .= '<ul class="vertical_scroll_css">';
				$str .= '<li class="current" data-id="0">تمام دسته ها</li>';
				foreach ( $categories as $category ) {
					$str .= sprintf( '<li data-id="%1$s">%2$s</li>', $category->term_id, esc_html( $category->name ) );
				}
			$str .= '</ul>';
		$str .= '</div>';
	}
	
	return $str;
	
}



/**
 * render search search form
 */
function mweb_render_search_form( $classes = '', $placeholder = '', $hide_filter = false ) {
	
	$str = '';
	if(empty($placeholder))
		$placeholder = 'کلید واژه مورد نظر ...';
	$mweb_search_filter = mweb_theme_util::get_theme_option( 'search_filter' );
	
	$btn_is_text = mweb_theme_util::get_theme_option('search_category_is_text');
	$has_title = $btn_is_text == true ? true : false;
	
	$taxonomy = in_array($mweb_search_filter, array('product', 'both')) ? 'product_cat' : 'category';
	
	$active_category = mweb_theme_util::get_theme_option('search_category');
	
	$search_cat = mweb_search_form_categories($taxonomy, $has_title, $hide_filter, $active_category);
	if(!empty($search_cat))
		$classes .= ' elm_has_cat';
	
	if($has_title == false && $active_category)
		$classes .= ' elm_has_cat_btn';
	
	$str .= '<form class="search_wrap '.$classes.'" id="ajax-form-search" method="get" action="'. esc_url( home_url( '/'  ) ) .'">';
		$str .= $search_cat;
		$str .= '<span class="search_clear"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#close-circle"></use></svg></span>';
		$str .= '<span class="search_icon"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#search"></use></svg></span>';
		$str .= '<input type="text" id="search-form-text" class="search-field" value="'. esc_attr( get_search_query() ) .'" name="s" placeholder="'.$placeholder.'" />';
		$str .= '<button> جستجو </button>';
			if ( in_array($mweb_search_filter, array('product', 'both')) ) {
				$str .= '<input type="hidden" name="post_type" value="product" />';
			}
		$str .= '<input type="hidden" id="search_cat_id" name="cat_id" value="" />';	
		$str .= '<div id="ajax-search-result"></div>';
	$str .= '</form>';
	
	return $str;
	
}



/**
 * display the social network
 */
function mweb_social_icons($classes = '', $has_name = false, $itemclass = ''){

	$socials = mweb_theme_util::get_theme_option('mweb_social_icons');

	if ( is_array($socials) && !empty($socials)){
		
		$label_arg = array(
			'facebook' => 'فیسبوک',
			'twitter' => 'توییتر',
			'instagram' => 'اینستاگرام',
			'telegram' => 'تلگرام',
			'flickr' => 'فلیکر',
			'youtube' => 'یوتیوب',
			'aparat' => 'آپارات',
			'behance' => 'بی هنس',
			'digg' => 'دیگ',
			'dribble' => 'دریبل',
			'dropbox' => 'درآپ باکس',
			'github' => 'گیت هاب',
			'linkedin' => 'لینکدین',
			'pinterest' => 'پینترست',
			'soundcloud' => 'ساندکلود',
			'spotify' => 'اسپاتیفای',
			'stack-overflow' => 'استک اورفالو',
			'vine' => 'واین',
			'vimeo-square' => 'ویمو'
		);
		if( $has_name == true )
			$classes .= ' has_label';
		echo '<div class="contact_social_wrap'.$classes.'">'; 
		foreach ( $socials as $social => $sol ) {
			$el_label = $has_name == true ? '<span>'.$label_arg[$social].'</span>' : '';
			if( !empty($sol) ){
				echo '<a href="'.esc_url($sol).'" target="_blank"'.( !empty($itemclass) ? ' class="'.$itemclass.'"' : '' ).'><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$social.'"></use></svg>'.$el_label.'</a>';
			}
			
		}
		echo '</div>';
	}
		
}



/**
 * display product social share list
 */
function mweb_get_product_share_list( $id = null ) {
	
	$id = empty($id) ? get_the_ID() : $id ;
	$shortlink = get_permalink();
	$title = get_the_title($id);
	
	
	//get the sharing media
	$websites = mweb_theme_util::get_theme_option('sharing_social_product',array());
	$links = array();
	if( !empty($websites) ){
		foreach ($websites as $site) :
			
			$media = isset($site) ? $site : '';
					
			switch ($media) {
				case 'facebook':
					$pre_link = 'https://www.facebook.com/sharer/sharer.php?u='.$shortlink.'&t='.$title;
					break;
				case 'twitter':
					$pre_link = 'https://twitter.com/share?url='.$shortlink;
					break;
				case 'google-plus':
					$pre_link = 'https://plus.google.com/share?url='.$shortlink;
					break;
				case 'digg':
					$pre_link = 'http://digg.com/submit?url='.$shortlink;
					break;
				case 'pinterest':
					$image = '';
					if (has_post_thumbnail()) {
						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id, 'full');
						$image = $image_url[0];
					} 
					$pre_link = 'https://pinterest.com/pin/create/bookmarklet/?media='.$image.'&url='.$shortlink;
					break;
				case 'linkedin':
					$pre_link = 'http://www.linkedin.com/shareArticle?mini=true&url='.$shortlink.'&title='.$title.'&source='.get_bloginfo ( 'url' );
					break;
				case 'buffer':
					$pre_link = 'http://bufferapp.com/add?text='.$title.'&url='.$shortlink;
					break;
				case 'tumblr':
					$pre_link = 'http://www.tumblr.com/share/link?url='.$shortlink.'&name='.$title;
					break;
				case 'reddit':
					$pre_link = 'http://reddit.com/submit?url='.$shortlink.'&title='.$title;
					break;
				case 'stumbleUpon':
					$pre_link = 'http://www.stumbleupon.com/submit?url='.$shortlink.'&title='.$title;
					break;
				case 'whatsapp':
					$pre_link = 'https://wa.me?text='.urlencode($shortlink);
					break;
				case 'sms':
					$pre_link = 'sms:?&body='.$title.urlencode($shortlink);
					break;
				case 'telegram':
					$pre_link = 'https://telegram.me/share/url?url='.$shortlink.'&title='.$title;
					break;
				default:
					$pre_link = '';
					break;
			}
			
			
			if ($pre_link != '')
				$this_link = '<li><a href="'.$pre_link.'" target="_blank" class="bg-'.$media.'"><svg viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$media.'"></use></svg></a></li>';
			
			$links[] = $this_link; 
			
		endforeach; 
		
		return empty($links) ? false : $links;
		
	}
	
}
 
 
 
 
/**
 * display product social share
 */
function mweb_get_product_share( $id = null ) {
	
	$links = mweb_get_product_share_list($id);
		
	$str  = '<span class="popup-share"><a href="#popup-share-wrap" rel="modal:open" title="اشتراک گذاری"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#share"></use></svg></a></span>';
	$str .= '<div id="popup-share-wrap" class="modal">';
		$str .= '<p>با استفاده از روش های زیر می توانید این صفحه را با دوستان خود به اشتراک بگذارید.</p>';
		$str .= '<div class="product_share coloring">';
			if ( is_array($links) ){
				$str .= '<ul>';
				$str .= implode( '', $links );
				$str .= '</ul>';
			}
		$str .= '</div>';
		$str .= '<div class="product_shortlink"><input class="text_copy" onClick="this.select();" value="'.wp_get_shortlink().'" /><i class="btn_copy"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#copy"></use></svg></i></div>';
	$str .= '</div>';
			
	echo $str;
	
}



/**
 * display search form
 */
function mweb_searchform($classes = ''){
	echo '<form class="search_form '.$classes.'" method="get" action="'.esc_url( home_url( '/' ) ).'">
	<input type="text" name="s" value="'. get_search_query() .'" placeholder="کلید واژه مورد نظر .."><button><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#search"></use></svg></button>
	</form>';
}



/**
 * @param      $excerpt_length
 * @param bool $display_short_code
 * excerpt
 */
function mweb_get_post_excerpt( $excerpt_length, $display_short_code = false ) {

	//check
	if ( empty( $excerpt_length ) ) {
		return false;
	}

	//render
	global $post;

	if ( ! empty( $post->post_excerpt ) ) {
		return  $post->post_excerpt;
	} else {
		$post_content = $post->post_content;
		if ( ! $display_short_code ) {
			$post_content = preg_replace( '`\[[^\]]*\]`', '', $post->post_content );
		}
		$post_content = stripslashes( wp_filter_nohtml_kses( $post_content ) );

		return wp_trim_words( $post_content, $excerpt_length, ' ...' );
	}
}



/**
 * render read more button
 */
function read_more($morelink) {

	if(empty($morelink)){
		return false;
	}
	//check option
	$read_more_style = mweb_theme_util::get_theme_option( 'read_more_style' );

	//render
	if($read_more_style == 'style1'){
		echo '<a class="read_more" href="'.$morelink.'" rel="bookmark" title="بیشتر"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg> بیشتر</a>';
	}
	else{
		echo '<a class="read_more--decor2" href="'.$morelink.'" rel="bookmark" title="بیشتر">بیشتر</a>';
	}

}



/**
 * render page pagination as html
 */
function mweb_pagination() {

	$mweb_pagination_style = mweb_theme_util::get_theme_option( 'page_pagination_style' );

	//check search page
	if ( is_search() || ( is_archive() && ! is_category() ) ) {
		$mweb_pagination_style = 'standard';
	}

	switch ( $mweb_pagination_style ) {
		case 'load_more' :
			mweb_pagination_load_more();
			break;
		default :
			mweb_pagination_standard();
			break;
	}
}



/**
 * @param null $custom_query
 * @param bool $echo
 *
 * @return string
 * render pagination standard
 */
function mweb_pagination_standard( $custom_query = null, $echo = true ) {
	global $wp_query, $wp_rewrite;

	if ( ! empty( $custom_query ) ) {
		$mweb_query = $custom_query;
	} else {
		$mweb_query = $wp_query;
	}

	if ( is_single() || ( $mweb_query->max_num_pages < 2 ) ) {
		return false;
	}

	$mweb_enable_simple_pagination = mweb_theme_util::get_theme_option( 'simple_page_pagination' );


	//render pagination
	$str = '';

	$str .= '<div class="pagination-wrap clear">';

	if ( empty( $mweb_enable_simple_pagination ) ) {
		$str .= '<div class="pagination-num">';
		$mweb_query->query_vars['paged'] > 1 ? $current = $mweb_query->query_vars['paged'] : $current = 1;
		$pagination = array(
			'base'      => @add_query_arg( 'paged', '%#%' ),
			'format'    => '',
			'total'     => $mweb_query->max_num_pages,
			'current'   => $current,
			'next_text' => '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg>',
			'prev_text' => '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-right-1"></use></svg>',
			'type'      => 'plain'
		);
		if ( $wp_rewrite->using_permalinks() ) {
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
		}
		if ( ! empty( $mweb_query->query_vars['s'] ) ) {
			$pagination['add_args'] = array( 's' => urlencode( get_query_var( 's' ) ) );
		}
		$str .= paginate_links( $pagination );
		$str .= '</div>';

	} else {
		$str .= '<div class="older">' . get_next_posts_link( esc_attr__( 'مطالب قدیمی', 'mweb' ) , $mweb_query->max_num_pages ) . '</div>';
		$str .= '<div class="newer">' . get_previous_posts_link( esc_attr__( 'مطالب جدید', 'mweb' ), $mweb_query->max_num_pages ) . '</div>';

	}
	$str .= '</div>';

	if ( true === $echo ) {
		echo( $str );
	} else {
		return $str;
	}
}



/**
 * render pagination load more
 */
function mweb_pagination_load_more($id, $pagination = "next_prev" ) {
	$str = '';
	switch ( $pagination ) {
		case "next_prev" :
			$str .= '<div class="next-prev-wrap">';
			$str .= '<a href="#" class="mweb-ajax-prev ajax-disable" id="prev_' . $id . '">قبل</a>';
			$str .= '<a href="#" class="mweb-ajax-next" id="next_' . $id . '">بعد</a>';
			$str .= '</div>';
			break;
		case 'loadmore':
			$str .= '<div class="loadmore-wrap">';
			$str .= '<a href="#" class="mweb-ajax-loadmore" id="loadmore_' . $id . '">بارگذاری بیشتر ...</a>';
			$str .= '<div class="loadmore-img-wrap">';
			$str .= '<div class="loadmore-img"></div>';
			$str .= '</div>';
			$str .= '</div>';
			break;
	}

	return $str;
}



/**
 * @param string $classes
 * @param string $sidebar_position
 * @param bool $disable_wrapper
 * open page wrap
 */
function mweb_open_page_wrap( $classes = '', $sidebar_position = '', $disable_row = false, $disable_wrapper = false  ) {

	//create wrap class
	$mweb_classes   = array();
	$mweb_classes[] = 'page-wrap';
	$mweb_classes[] = esc_attr( $classes );
	if($sidebar_position ){
	$mweb_classes[] = 'is-sidebar-' . esc_attr( $sidebar_position );
	}
	if ( false === $disable_wrapper ) {
		$mweb_classes[] = 'container';
	}
	
	$mweb_classes = implode( ' ', $mweb_classes );

	//render
	echo '<div class="' . esc_attr( $mweb_classes ) . '">';
	if($disable_row === false){
		echo '<div class="row">';
	}

}



/**
 * @param string $classes
 * @param string $sidebar_position
 * @param string $blog_layout
 * @param bool $big_first
 * open page inner
 */
function mweb_open_page_inner( $classes = '', $sidebar_position = '', $blog_layout = '') {

	//create wrap class
	$mweb_classes   = array();
	$mweb_classes[] = 'content-wrap';
	$mweb_classes[] = esc_attr( $classes );
		
		// is_single()  && !has_post_format( 'gallery' ) && !has_post_format( 'video' )
		if ( 'none' == $sidebar_position ) {
			$mweb_classes[] = 'content-without-sidebar col-12';
		} else {
			$mweb_classes[] = 'col-12 col-sm-12 col-md-12 col-lg-9 content-with-sidebar';
		}
							

	
	$mweb_classes = implode( ' ', $mweb_classes );

	//render
	echo '<div class="' . esc_attr( $mweb_classes ) . '">';
	
}



/**
 * @return string
 * open content inner
 */
function mweb_open_ajax_wrap() {
	return '<div class="ajax-wrap">';
}



/**
 * @return string
 * open content inner
 */
function mweb_open_content_inner($disable_row = true) {
	echo '<div class="content-inner">';
	if($disable_row === false){
		echo '<div class="row">';
	}
}



/**
 * close page inner
 */
function mweb_close_page_inner() {
	echo '</div>';
}



/**
 * close page wrap
 */
function mweb_close_page_wrap( $disable_row = false) {
	if($disable_row === false){
		echo '</div>';
	}
	echo '</div>';
}



/**
 * close content inner
 */
function mweb_close_content_inner($disable_row = true) {
	if($disable_row === false){
		echo '</div>';
	}
	echo '</div>';
}



/**
 * close page inner
 */
function mweb_close_ajax_wrap() {
	return '</div>';
}



/**
 * @param      $name
 * @param bool $disable_makeup
 * render sidebar
 */
function mweb_get_sidebar( $name, $disable_makeup = false ) {

	//sticky config
	$sticky = mweb_theme_util::get_theme_option( 'sticky_sidebar' );

	//makeup
	if ( false === $disable_makeup ) {
		$makeup = mweb_theme_schema::makeup( 'sidebar', false );
	} else {
		$makeup = '';
	}
	
	$mweb_class ='col-12 col-sm-12 col-md-12 col-lg-3';
	

	if ( ! empty( $sticky ) ) {
		echo '<div id="sidebar" class="sidebar-wrap '.$mweb_class.' clearfix" ' . $makeup . '><div class="mweb-sidebar-sticky">';
		echo '<div class="sidebar-inner">';
		if ( is_active_sidebar( $name ) ) {
			dynamic_sidebar( $name );
		}
		echo '</div>';
		echo '</div></div>';
	} else {
		echo '<div id="sidebar" class="sidebar-wrap '.$mweb_class.' clearfix" ' . $makeup . '>';
		echo '<div class="sidebar-inner">';
		if ( is_active_sidebar( $name ) ) {
			dynamic_sidebar( $name );
		}
		echo '</div>';
		echo '</div>';
	}
}
 
 
 
/**
 * @param string $class
 *
 * @return string
 * render divider
 */
function mweb_render_divider( $classes = '' ) {
	return '<div class="' . esc_attr( $classes ) . ' is-divider"></div>';
}



/**
 * @return string
 * no content post found
 */
function mweb_no_content() {
	return '<div class="mweb-error"><h3>' . esc_attr__( 'متاسفانه محتوایی یافت نشد!', 'mweb' ) . '</h3></div>';
}



/**
 * @return string
 * error msg
 */
function mweb_error($msg = '') {
	return '<div class="mweb-error"><h3>' . $msg . '</h3></div>';
}



/**
 * @param int $count
 *
 * @return string
 *  not enough post for block
 */
function mweb_not_enough_post( $count = 6 ) {
	return '<div class="mweb-error"><p>' . sprintf( esc_html__( 'متاسفانه تعداد محتوای ( حداقل %s ) کافی برای این بلاک وجود ندارد.', 'mweb' ), $count ) . '</p></div>';
}