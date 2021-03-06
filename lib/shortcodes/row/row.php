<?php namespace CAHNRSWP\Plugin\Pagebuilder;

?><?php if ( ! empty( $settings['anchor'] ) ) : ?><a name="<?php echo esc_html( $settings['anchor'] ); ?>"></a><?php endif; ?>
<div class="cpb-row <?php echo esc_html( $classes ); ?>" style="<?php echo esc_html( $style ); ?>">
	<?php if ( ! empty( $bg_src ) ) : ?><div class="row-bg-image recto verso unbound" style="background-image:url(<?php echo esc_url( $settings['bg_src'] ); ?> )"></div><?php endif; ?>
	<div class="cpb-row-inner">
		<?php if ( ! empty( $settings['title'] ) ) : ?><h2 class="row-title"><?php echo esc_html( $settings['title'] ); ?></h2><?php endif; ?>
		<?php echo do_shortcode( $content ); ?>
	</div>
 </div>
