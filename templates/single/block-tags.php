<?php
//get tag
$mweb_tags = get_the_tags();
?>
<?php if ( ! empty( $mweb_tags ) ) : ?>
	<div class="blog_tag_wrap">
		<span class="tags-title">کلیدواژه : </span>
		<?php
		foreach ( $mweb_tags as $mweb_tag ) {
			$mweb_tag_link = get_tag_link( $mweb_tag->term_id );
			echo '<a href="' . esc_url( $mweb_tag_link ) . '" title="' . esc_attr( strip_tags( $mweb_tag->name ) ) . '">' . esc_attr( $mweb_tag->name ) . '</a>';
		} ?>
	</div>
<?php endif; ?>