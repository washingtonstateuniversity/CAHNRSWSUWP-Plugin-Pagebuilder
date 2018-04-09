<?php namespace CAHNRSWP\Plugin\Pagebuilder;

?><div class="cpb-az-index-column">
<?php foreach ( $col_items as $index => $item ) :
	$class = ( ! empty( $item['link'] ) ) ? ' has-link' : '';
?><div class="cpb-az-index-column-item <?php echo esc_html( $class ); ?>">
	<h3 class="cpb-az-index-column-item-title"><?php echo esc_html( $item['title'] ); ?></h3>
	<?php if ( ! empty( $item['link'] ) ) :
		?><div><a class="cpb-az-index-column-item-link" href="<?php echo esc_url( $item['link'] ); ?>">Visit: <?php echo esc_html( $item['title'] ); ?></a></div>
	<?php endif; ?>
	</div>
<?php endforeach; ?>
</div>
