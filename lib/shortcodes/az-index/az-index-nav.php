<?php namespace CAHNRSWP\Plugin\Pagebuilder;

?><nav class="cpb-az-index-nav">
<?php
$is_set_active = false;
foreach ( $alpha_items as $alpha => $items ) :
//@codingStandardsIgnoreStart
?>
<div class="cpb-az-index-nav-item <?php if ( ! empty( $items ) ) : ?> has-items<?php endif; ?><?php if ( ! empty( $items ) && $is_set_active ) : $is_set_active = false; ?> active<?php endif; ?>"><?php echo esc_html( strtoupper( $alpha ) ); ?></div>
<?php
//@codingStandardsIgnoreEnd
endforeach; ?>
</nav>
