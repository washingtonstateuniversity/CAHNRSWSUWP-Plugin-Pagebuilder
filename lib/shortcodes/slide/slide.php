<?php namespace CAHNRSWP\Plugin\Pagebuilder;

?><li class="slide gallery-slide<?php echo esc_html( $active ); ?>">
	<?php
	// @codingStandardsIgnoreStart These should are already escaped
	echo $img;
	echo $link;
	// @codingStandardsIgnoreEnd
	?><ul class="cpb-slide-caption">
		<?php if ( ! empty( $title ) ) : ?><li class="cpb-slide-title"><?php echo esc_html( $title ); ?></li><?php endif; ?>
		<?php if ( ! empty( $excerpt ) ) : ?><li class="cpb-slide-excerpt"><?php echo wp_kses_post( $excerpt ); ?></li><?php endif; ?>
		<?php if ( ! empty( $link ) ) : ?><li class="cpb-slide-link"><?php echo esc_url( $link ); ?></li><?php endif; ?>
	</ul>
</li>
