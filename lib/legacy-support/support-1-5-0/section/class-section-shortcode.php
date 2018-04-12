<?php namespace CAHNRSWP\Plugin\Pagebuilder;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle Section Shortcode
* @since 3.0.0
*/
class Section_Shortcode {

	protected $prefix = '';

	// @var array $default_settings Array of default settings
	protected $default_settings = array();


	public function __construct() {

		\add_action( 'init', array( $this, 'register_shortcode' ) );

	} // End __construct


	/*
	* @desc Register section shortcode
	* @since 3.0.0
	*/
	public function register_shortcode() {

		\add_shortcode( 'section', array( $this, 'get_rendered_shortcode' ) );

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, array(), 'section' );

		cpb_register_shortcode(
			'section',
			$args = array(
				'form_callback'         => array( $this, 'get_shortcode_form' ),
				'label'                 => 'Section', // Label of the item
				'render_callback'       => array( $this, 'get_rendered_shortcode' ), // Callback to render shortcode
				'default_atts'          => $default_atts,
				'in_column'             => false, // Allow in column
			)
		);

	} // End register_shortcode


	/*
	* @desc Render the shortcode
	* @since 3.0.0
	*
	* @param array $atts Shortcode attributes
	* @param string $content Shortcode content
	*
	* @return string HTML shortcode output
	*/
	public function get_rendered_shortcode( $atts, $content ) {

		$html = '';

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, $atts, 'section' );

		// Check default settings
		$atts = \shortcode_atts( $default_atts, $atts, 'section' );

		$html = do_shortcode( $content );

		return $html;

	} // End get_rendered_shortcode


	/*
	* @desc Get HTML for shortcode form
	* @since 3.0.0
	*
	* @param array $atts Shortcode attributes
	* @param string $content Shortcode content
	*
	* @return string HTML shortcode form output
	*/
	public function get_shortcode_form( $id, $settings, $content ) {

		return array(
			'Basic'    => '',
		);

	} // End get_shortcode_form

} // End Section

$cpb_shortcode_section = new Section_Shortcode();
