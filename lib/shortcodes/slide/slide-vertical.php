<?php namespace CAHNRSWP\Plugin\Pagebuilder;

?><li class="slide gallery-slide<?php echo esc_html( $active ); ?> <?php echo esc_attr( $slide_index ); ?> <?php echo esc_attr( $slide_class ); ?>">
<?php if ( ! empty( $img ) ) : ?><div class="cpb-slide-img"><?php echo wp_kses_post( $img ); ?></div><?php endif; ?>
<?php if ( ! empty( $link ) ) : ?><div class="cpb-slide-link"><?php echo wp_kses_post( $link ); ?></div><?php endif; ?>
	<ul class="cpb-slide-caption">
		<?php if ( ! empty( $title ) ) : ?><li class="cpb-slide-title"><?php echo esc_html( $title ); ?></li><?php endif; ?>
		<?php if ( ! empty( $excerpt ) ) : ?><li class="cpb-slide-excerpt"><?php echo wp_kses_post( $excerpt ); ?></li><?php endif; ?>
	</ul>
</li>
