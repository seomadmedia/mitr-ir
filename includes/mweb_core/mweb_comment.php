<?php
/**
 * Class mweb_theme_featured
 */


/*-----------------------------------------------------------------------------------*/
/* Get comment posts
/*-----------------------------------------------------------------------------------*/

function mweb_layout_comments($comment, $args, $depth) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>
<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent', $comment ); ?>>
      <article id="comment-<?php comment_ID() ?>" class="comment-body">
      <div class="comment-top">

      <div class="comment-meta">
          <div class="comment-info">
              <cite class="comment-author"><span><?php echo mweb_convert_to_stars(get_comment_author(), true) ?></span></cite>
              <span><?php printf(__('%1$s / %2$s', 'mahdisweb'), get_comment_date('j M Y'),  get_comment_time()) ?></span>
             
          </div>

          <div class="action-link">
          <?php $reply_args = array_merge( $args, array('reply_text' => __('پاسخ', 'mahdisweb'), 'depth' => $depth, 'max_depth' => $args['max_depth'])); ?> 					
          <?php comment_reply_link($reply_args, $comment->comment_ID); ?>
         </div><!-- .action-link -->
          <?php if( function_exists("get_post_ul_meta") ) : ?>
				 <span class="comment-like" onclick="alter_ul_post_values(this,'<?php echo get_comment_ID(); ?>','c_like')"><i class="fa fa-plus-square"></i><span><?php echo get_post_ul_meta(get_comment_ID(),"c_like"); ?></span></span>
				 <span class="comment-dislike" onclick="alter_ul_post_values(this,'<?php echo get_comment_ID(); ?>','c_dislike')"><i class="fa fa-minus-square"></i><span><?php echo get_post_ul_meta(get_comment_ID(),"c_dislike"); ?></span></span>
		  <?php endif; ?>

      </div>

      </div>

          <div class="comment-content">
            <?php if ($comment->comment_approved == '0') : ?>
                <p><em><?php _e('منتظر تایید مدیر است', 'mahdisweb'); ?></em></p>
            <?php else: ?>
                <?php comment_text(); ?>
            <?php endif; ?>
          </div>

      </article>

    <?php 
}










