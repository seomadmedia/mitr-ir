<?php

/**
 * Class mweb_theme_post_related
 * this file support related post
 */
if ( ! class_exists( 'mweb_theme_post_related' ) ) {
	class mweb_theme_post_related {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array|string
		 * get related data
		 */
		static function get_data() {
			//check enable related box
			$related = mweb_theme_util::get_theme_option( 'mweb_show_relpost' );
			if ( empty( $related ) ) {
				return false;
			}

			//query related
			$related_where   = mweb_theme_util::get_theme_option( 'single_related_where' );
			$number_of_post  = mweb_theme_util::get_theme_option( 'mweb_num_relpost' );
			$categories_data = get_the_category();
			$tags_data       = get_the_tags();
			$category_ids    = '';
			$tags            = '';
			$options         = array();
			$query_data      = '';

			//get string category id
			foreach ( $categories_data as $category ) {
				$category_ids .= $category->term_id . ',';
			}

			$category_ids = substr( $category_ids, 0, - 1 );

			//get string tags
			if ( ! empty( $tags_data ) ) {
				foreach ( $tags_data as $tag ) {
					$tags .= $tag->slug . ',';
				}
				$tags = substr( $tags, 0, - 1 );
			} else {

				//set same category if tags not found
				$related_where = 'categories';
			}

			//get number of related
			if ( empty( $number_of_post ) ) {
				$options['posts_per_page'] = 3;
			} else {
				$options['posts_per_page'] = $number_of_post;
			}

			$options['post_not_in'] = get_the_ID();

			switch ( $related_where ) {

				//case all
				case 'all' : {
					$options['tags'] = $tags;
					$query_data      = mweb_theme_query::get_custom_query( $options )->posts;

					//check not enough post by tags
					$count = count( $query_data );

					if ( $count < $options['posts_per_page'] ) {

						//reset query options
						foreach ( $query_data as $post_related ) {
							$options['post_not_in'] .= ',' . $post_related->ID;
						}
						$options['category_ids'] = $category_ids;
						unset( $options['tags'] );
						$options['posts_per_page'] = $options['posts_per_page'] - $count;
						$query_data_more           = mweb_theme_query::get_custom_query( $options )->posts;

						//add categories related to tags related
						if ( ! empty( $query_data_more ) ) {
							foreach ( $query_data_more as $data ) {
								$query_data[] = $data;
							}
						}
					};

					break;
				}

				case 'tags' : {
					$options['tags'] = $tags;
					$query_data      = mweb_theme_query::get_custom_query( $options )->posts;
					break;
				}

				case 'categories' : {
					$options['category_ids'] = $category_ids;
					$query_data              = mweb_theme_query::get_custom_query( $options )->posts;
					break;
				}
			};

			return $query_data;
		}

	}
}