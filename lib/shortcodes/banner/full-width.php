<?php namespace CAHNRSWP\Plugin\Pagebuilder;

?><div class="cpb-banner display-full-width">
	<div class="cpb-banner-image-wrapper" style="<?php echo esc_attr( $height_style ); ?>">
		<div class="cpb-banner-image" style="background-image:url(<?php echo esc_url( $settings['img_src'] ); ?>)">
		</div>
	</div><div class="cpb-banner-content-wrapper">
		<div class="cpb-banner-image-content" style="<?php echo esc_attr( $height_style ); ?>">
			<?php if ( ! empty( $settings['content'] ) ) : ?><div class="cpb-banner-content"><?php echo wp_kses_post( $settings['content'] ); ?></div><?php endif; ?>
		</div><?php if ( ! empty( $settings['caption'] ) ) : ?><div class="cpb-banner-caption-wrapper">
			<div class="cpb-banner-caption"><?php echo wp_kses_post( $settings['caption'] ); ?></div>
		</div><?php endif; ?>
	</div>
</div>
