<div class="entry entry-content">

	<?php the_post_thumbnail('large' , array('class'=> 'single_blog_thumb')); ?>
	<?php the_content('ادامه مطلب'); ?>
	<?php
	wp_link_pages(
		array(
			'before'      => '<div class="single-page-links">',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'echo'        => true
		)
	);    ?>

</div>
