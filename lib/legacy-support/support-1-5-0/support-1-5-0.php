<?php namespace CAHNRSWP\Plugin\Pagebuilder;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle legacy support for Pagebuilder 1.5.0
* @since 3.0.5
*/
class Support_1_5_0 {


	public function __construct() {

		$this->add_shortcodes();

		add_filter( 'cpb_shortcode_default_atts', array( $this, 'filter_default_atts' ), 10, 3 );

	} // End __construct


	/*
	* @desc Add shortcodes for 1.5.0 support
	* @since 3.0.5
	*/
	protected function add_shortcodes() {

		include_once cpb_get_plugin_path( '/lib/legacy-support/support-1-5-0/section/class-section-shortcode.php' );

	} // End add_shortcodes


	/*
	* @desc Filter default atts to support legacy settings
	* @since 3.0.5
	*
	* @param array $default_atts Default atts
	* @param array $atts Set shortcode atts
	* @param string $tag Shortcode tag
	*
	* @return array Filtered default atts
	*/
	public function filter_default_atts( $default_atts, $atts, $tag ) {

		switch ( $tag ) {

			case 'promo':
				$default_atts = $this->get_promo_default_atts( $default_atts, $atts );
				break;

		} // End switch

		return $default_atts;

	} // End filter_default_atts


	/*
	* @desc Filter default atts to support legacy settings
	* @since 3.0.5
	*
	* @param array $default_atts Default atts
	* @param array $atts Set shortcode atts
	*
	* @return array Filtered default atts
	*/
	protected function get_promo_default_atts( $default_atts, $atts ) {

		if ( ! empty( $atts['source'] ) ) {

			$default_atts['promo_type'] = $atts['source'];

		} // End if

		return $default_atts;

	} // End get_promo_default_atts


} // End Scripts

$cpb_legacy_support_1_5_0 = new Support_1_5_0();
