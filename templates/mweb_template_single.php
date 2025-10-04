<?php

/**
 * @param string $class
 * @param bool   $review
 * render open single tag
 */
function mweb_open_single_wrap( $class = '' ) {
	
	
	if ( ! empty( $ajax_view ) && function_exists( 'mweb_theme_post_view_add' ) ) {
		$class = $class . ' ' . 'mweb-ajax-view-add';
	}
	$str = '<article class="' . implode( ' ', get_post_class( $class ) ) . '" ' . mweb_theme_schema::makeup( 'article', false );
	if ( ! empty( $ajax_view ) && function_exists( 'mweb_theme_post_view_add' ) ) {
	$str .= ' ' . 'data-post_id ="' . get_the_ID() . '"';
	}
	$str .= '>';
	
	echo $str;
	
}





/**
 * render close single tag
 */
function mweb_close_single_wrap() {
	echo '</article>';
}



		
		
/**
 * get single post meta - post format
 */
function mweb_get_single_post_icon() {
	return '<div class="blog_icon">'. mweb_post_format_icon() .'</div>';
}





/**
 * get single post meta author
 */
function mweb_get_single_post_author() {
	return '<i class="meta-items-i"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#user-edit"></use></svg>'. get_the_author_meta( 'display_name' ) .'</i>';
}






/**
 * get single post meta - post date
 */
function mweb_get_single_post_date() {
	$mweb_date_unix = get_the_time( 'U', get_the_ID() );
	return '<i class="meta-items-i"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#clock"></use></svg><time datetime="'. date( DATE_W3C, $mweb_date_unix ) .'">'. get_the_date( 'j  F  Y', get_the_ID() ) .'</time></i>';
}





/**
 * get single post meta - comment count
 */
function mweb_get_single_post_comment_count() {
	$str = '';
	if ( comments_open() )  :
		$mweb_count_comment = get_comments_number();
		$str .= '<div class="blog_comment hide_mobile">';
		if ( 0 == $mweb_count_comment ) :
			$str .= __( 'فاقد دیدگاه', 'mweb' );
		elseif ( 1 == $mweb_count_comment ) :
			$str .= __( '1 دیدگاه', 'mweb' ); 
		else : 
			$str .= esc_attr( $mweb_count_comment ) . ' ' . __( 'دیدگاه', 'mweb' ); 
		endif;
		$str .= '</div>';
	endif; 
	
	return $str;
}






/**
 * @return mixed|string
 * get first_paragraph setting
 */
function mweb_check_single_comment_box() {

	$mweb_comment_box = get_post_meta( get_the_ID(), 'mweb_single_comment_box', true );
	if ( 'default' == $mweb_comment_box || empty( $mweb_comment_box ) ) {
		$mweb_comment_box = mweb_theme_util::get_theme_option( 'mweb_single_comment' );
	};

	return $mweb_comment_box;
}
		
		
		
		
		
/**
 * get single sidebar position
 */
function mweb_get_single_sidebar_position() {

	//sidebar position
	$post_id          = get_the_ID();
	$sidebar_position = get_post_meta( $post_id, 'mweb_sidebar_position', true );

	//override sidebar position
	if ( 'default' == $sidebar_position || empty( $sidebar_position ) ) {
		$sidebar_position = mweb_theme_util::get_theme_option( 'single_sidebar_position' );
	}

	return $sidebar_position;
}





/**
 * @param bool $disable_makeup
 * render single sidebar
 */
function mweb_single_sidebar( $disable_makeup = false ) {

	//check
	$sidebar_position = mweb_get_single_sidebar_position();
	if ( 'none' == $sidebar_position ) {
		return false;
	}

	$all_sidebar = mweb_theme_config::sidebar_name( true );

	//single sidebar name
	$sidebar_name = get_post_meta( get_the_ID(), 'mweb_sidebar_title', true );
	if ( ! array_key_exists( $sidebar_name, $all_sidebar ) ) {
		$sidebar_name = 'mweb_default_from_theme_options';
	}
	if ( 'mweb_default_from_theme_options' == $sidebar_name || empty( $sidebar_name ) ) {
		$sidebar_name = mweb_theme_util::get_theme_option( 'default_single_post_sidebar' );
	}

	//render
	mweb_get_sidebar( $sidebar_name, $disable_makeup );
}





/**
 * @param $classes
 * render single post social sharing 
 */
function mweb_single_social_sharing($classes = ''){
	
	$shortlink = wp_get_shortlink();
	$title = get_the_title(get_the_ID());
	$image = '';
	if (has_post_thumbnail()) {
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id, 'full');
		$image = $image_url[0];
	} 
	
	//get the sharing media
	$websites = mweb_theme_util::get_theme_option('sharing_social_medias',array());
	$links = array();
	if(!empty($websites)){
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
					$pre_link = 'https://pinterest.com/pin/create/bookmarklet/?media='.$image.'&url='.$shortlink;
					break;
				case 'linkedin':
					$pre_link = 'http://www.linkedin.com/shareArticle?url='.$shortlink.'&title='.$title;
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
				case 'telegram':
					$pre_link = 'https://telegram.me/share/url?url='.$shortlink.'&title='.$title;
					break;
				default:
					$pre_link = '';
					break;
			}
			
			if ($pre_link != '')
				$this_link = '<li><a href="'.$pre_link.'" target="_blank"><svg viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$media.'"></use></svg></a></li>';
			
			
			$links[] = $this_link; 
		endforeach; 
			
		$output = '<div class="social_icons '.$classes.'"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#share"></use></svg>';
		if ( !empty ($links) ){
			$output .= '<div class="blog_socials"><ul>';
			$output .= implode( '', $links);
			$output .= '</ul></div>';
		}
		$output .='</div>';

		echo $output;
			
	}
	   
}







/**
 * get breadcrumbs
 */
function mweb_get_breadcrumbs( $showOnHome = 0, $classes = 'col-12', $has_wrap = true, $delimiter = '' ) {
			   
	$delimiter = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg>';
	$home = 'صفحه نخست'; 
	$showCurrent = 1; 
	$before = '<li class="active">'; 
	$after = '</li>'; 

	global $post;
	$homeLink = get_bloginfo('url');
	if( $has_wrap )
		echo '<div class="'.$classes.'">';
	
	if ( is_home() || is_front_page() ) {

	if ($showOnHome == 1) echo '<ol class="breadcrumb-arrow '.$classes.'"><li><a href="' . $homeLink . '">' . $home . '</a></li></ol>';

	} else {

		echo '<ol class="breadcrumb-arrow"><li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
				echo $before . '' . single_cat_title('', false) . '' . $after;

		} elseif ( is_search() ) {
			echo $before . 'جستجو برای"' . get_search_query() . '"' . $after;

		} elseif ( is_day() ) {
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . '</li> ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				$cats = get_category_parents($cat, true, ',');
				$cat_parents = explode(',',$cats);
				  
				// Loop through parent categories and store in variable $cat_display
				$cat_display = '';
				$cat_parents = array_filter($cat_parents);
				foreach($cat_parents as $parents) {
					$cat_display .= '<li>'. $parents . $delimiter .'</li>';
				}
				echo $cat_display;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> ');
			echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
		if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . '</li> ';
			}
			if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . 'برچسب مطلب"' . single_tag_title('', false) . '"' . $after;

		} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo $before . 'مطالب نویسنده  ' . $userdata->display_name . $after;

		} elseif ( is_404() ) {
				echo $before . 'خطای 404' . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</ol>';

	}
	
	if( $has_wrap )
		echo '</div>';
	
} // breadcrumbs