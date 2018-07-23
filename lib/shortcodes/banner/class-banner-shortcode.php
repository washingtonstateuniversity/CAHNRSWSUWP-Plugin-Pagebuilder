<?php namespace CAHNRSWP\Plugin\Pagebuilder;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle Banner Shortcode
* @since 3.0.0
*/
class Banner_Shortcode {

	protected $prefix = '';

	// @var array $default_settings Array of default settings
	protected $default_settings = array(
		'img_src'         => '',
		'img_id'          => '',
		'display'         => '',
		'height'          => '',
		'csshook'         => '',
		'caption'         => '',
		'content'         => '',
	);


	public function __construct() {

		\add_action( 'init', array( $this, 'register_shortcode' ) );

	} // End __construct


	/*
	* @desc Register Banner shortcode
	* @since 3.0.0
	*/
	public function register_shortcode() {

		\add_shortcode( 'banner', array( $this, 'get_rendered_shortcode' ) );

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, array(), 'banner' );

		cpb_register_shortcode(
			'banner',
			$args = array(
				'form_callback'         => array( $this, 'get_shortcode_form' ),
				'label'                 => 'Banner', // Label of the item
				'render_callback'       => array( $this, 'get_rendered_shortcode' ), // Callback to render shortcode
				'default_atts'          => $default_atts,
				'in_column'             => true, // Allow in column
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

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, $atts, 'Banner' );

		// Check default settings
		$settings = \shortcode_atts( $default_atts, $atts, 'Banner' );

		$settings['caption'] = htmlspecialchars_decode( str_replace( '&amp;', '&', $settings['caption'] ) );

		$settings['content'] = htmlspecialchars_decode( str_replace( '&amp;', '&', $settings['content'] ) );

		$html = '';

		switch ( $settings['display'] ) {

			case 'full-width':
				$html .= $this->get_display_full_width( $settings );
				break;
			default:
				//$html .= $this->get_display_basic( $settings );
				break;

		} // End switch

		return $html;

	} // End get_rendered_shortcode


	protected function get_display_full_width( $settings ) {

		$html = '';

		$height_style = ( $settings['height'] ) ? 'height:' . $settings['height'] . ';' : '';

		if ( ! empty( $settings['img_src'] ) ) {

			ob_start();

			include 'full-width.php';

			$html .= ob_get_clean();

		} // End if

		return $html;

	} // End get_display_basic


	/*
	* @desc Get HTML for shortcode form
	* @since 3.0.0
	*
	* @param array $atts Shortcode attributes
	* @param string $content Shortcode content
	*
	* @return string HTML shortcode form output
	*/
	public function get_shortcode_form( $id, $settings, $content, $cpb_form ) {

		$cpb_form = cpb_get_form_class();

		$settings['caption'] = htmlspecialchars_decode( str_replace( '&amp;', '&', $settings['caption'] ) );

		$settings['content'] = htmlspecialchars_decode( str_replace( '&amp;', '&', $settings['content'] ) );

		$basic = $cpb_form->insert_media( cpb_get_input_name( $id, true ), $settings );

		$banner_styles = array(
			'basic'       => 'Basic',
			'full-width'  => 'Full Width',
		);

		$basic .= $cpb_form->select_field( cpb_get_input_name( $id, true, 'display' ), $settings['display'], $banner_styles, 'Display Style' );

		$basic .= $cpb_form->text_field( cpb_get_input_name( $id, true, 'height' ), $settings['height'], 'Banner Height' );

		$basic .= $cpb_form->text_field( cpb_get_input_name( $id, true, 'csshook' ), $settings['csshook'], 'CSS Hook' );

		$content .= $cpb_form->textarea_field( cpb_get_input_name( $id, true, 'caption' ), $settings['caption'], 'Banner Caption' );

		$content .= $cpb_form->textarea_field( cpb_get_input_name( $id, true, 'content' ), $settings['content'], 'Banner Inner Content' );

		return array(
			'Basic'    => $basic,
			'Content'  => $content,
		);

	} // End get_shortcode_form

} // End Banner

$cpb_shortcode_banner = new Banner_Shortcode();
