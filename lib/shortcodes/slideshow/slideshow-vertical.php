<?php namespace CAHNRSWP\Plugin\Pagebuilder;

?><div class="cpb-slideshow <?php echo esc_html( $atts['display_type'] ); ?>" <?php echo esc_html( $data_attrs ); ?>>
	<div class="slides-wrapper">
		<?php // @codingStandardsIgnoreStart Already escaped ?><ul class="slides"><?php echo $slides ; ?></ul><?php // @codingStandardsIgnoreEnd ?>
		<nav class="slideshow-primary"><a href="#" class="prev">Previous</a><a href="#" class="next">Next</a></nav>
	</div>
	<nav class="slideshow-secondary"></nav>
</div>
