<?php namespace CAHNRSWP\Plugin\Pagebuilder;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle AZ Index Shortcode
* @since 3.0.1
*/
class AZ_Index_Shortcode {

	protected $prefix = '';

	// @var array $default_settings Array of default settings
	protected $default_settings = array(
		'source_type' => '',
	);


	public function __construct() {

		$local_query_defaults = cpb_get_local_query_defaults();

		$remote_query_defaults = cpb_get_remote_query_defaults();

		$this->default_settings = array_merge(
			$this->default_settings,
			$local_query_defaults,
			$remote_query_defaults
		);

		\add_action( 'init', array( $this, 'register_shortcode' ) );

	} // End __construct


	/*
	* @desc Register az_index shortcode
	* @since 3.0.1
	*/
	public function register_shortcode() {

		\add_shortcode( 'az_index', array( $this, 'get_rendered_shortcode' ) );

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, array(), 'az_index' );

		cpb_register_shortcode(
			'az_index',
			$args = array(
				'form_callback'         => array( $this, 'get_shortcode_form' ),
				'label'                 => 'AZ Index', // Label of the item
				'render_callback'       => array( $this, 'get_rendered_shortcode' ), // Callback to render shortcode
				'default_atts'          => $default_atts,
				'in_column'             => true, // Allow in column
			)
		);

	} // End register_shortcode


	/*
	* @desc Render the shortcode
	* @since 3.0.1
	*
	* @param array $atts Shortcode attributes
	* @param string $content Shortcode content
	*
	* @return string HTML shortcode output
	*/
	public function get_rendered_shortcode( $atts, $content ) {

		$html = '';

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, $atts, 'az_index' );

		// Check default settings
		$atts = \shortcode_atts( $default_atts, $atts, 'az_index' );

		$atts['count'] = '-1';

		$atts['order_by'] = 'title';

		$atts['order'] = 'ASC';

		$class = ( ! empty( $atts['csshook'] ) ) ? $atts['csshook'] : '';

		$html .= '<div class="cpb-item cpb-az-index-wrap ' . $class . '">';

		$items = $this->get_items( $atts );

		$alpha_items = $this->get_alpha_items( $items, $atts );

		ob_start();

		include __DIR__ . '/az-index-nav.php';

		$html .= ob_get_clean();

		$html .= $this->get_az_index_content( $alpha_items, $atts );

		return $html;

	} // End get_rendered_shortcode


	/*
	* @desc Get HTML for shortcode form
	* @since 3.0.1
	*
	* @param array $atts Shortcode attributes
	* @param string $content Shortcode content
	*
	* @return string HTML shortcode form output
	*/
	public function get_shortcode_form( $id, $settings, $content, $cpb_form ) {

		$cpb_form = cpb_get_form_class();

		$feed_form = array(
			'name'    => cpb_get_input_name( $id, true, 'source_type' ),
			'value'   => 'feed',
			'selected' => $settings['source_type'],
			'title'   => 'Feed (This Site)',
			'desc'    => 'Load content by category or tag',
			'form'    => $cpb_form->get_form_local_query( cpb_get_input_name( $id, true ), $settings ),
		);

		$remote_feed_form = array(
			'name'    => cpb_get_input_name( $id, true, 'source_type' ),
			'value'   => 'remote_feed',
			'selected' => $settings['source_type'],
			'title'   => 'Feed (Another Site)',
			'desc'    => 'Load external content by category or tag',
			'form'    => $cpb_form->get_form_remote_feed( cpb_get_input_name( $id, true ), $settings ),
		);

		$html = $cpb_form->multi_form( array( $feed_form, $remote_feed_form ) );

		return array( 'Source' => $html );

	} // End get_shortcode_form


	protected function get_items( $settings ) {

		$query = cpb_get_query_class();

		switch ( $settings['source_type'] ) {

			case 'feed':
				$items = $query->get_local_items( $settings, '' );
				break;
			case 'remote_feed':
				$items = $query->get_remote_items_feed( $settings, '' );
				break;

			default:
				$items = array();
				break;

		} // end switch

		return $items;

	} // End get_items


	protected function get_alpha_items( $items, $settings ) {

		$alpha = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z' );

		$alpha_array = array();

		foreach ( $alpha as $index => $al ) {

			$alpha_array[ $al ] = array();

		} // End foreach

		$alpha_num = array(
			1 => 'o',
			2 => 't',
			3 => 't',
			4 => 'f',
			5 => 'f',
			6 => 's',
			7 => 's',
			8 => 'e',
			9 => 'n',
		);

		foreach ( $items as $index => $item ) {

			$let = strtolower( $item['title'][0] );

			if ( array_key_exists( $let, $alpha_num ) ) {

				$let = $alpha_num[ $let ];

			} // End if

			$alpha_array[ $let ][] = $item;

		} // End foreach

		return $alpha_array;

	} // End get_alpha_items


	protected function get_az_index_content( $alpha_items, $settings ) {

		$html = '<div class="cpb-az-index-alpha-content">';

		$has_active = true;

		foreach ( $alpha_items as $key => $alpha_set ) {

			$active = '';

			if ( ! empty( $alpha_set ) && $has_active ) {

				$active = ' active';

				$has_active = false;

			} // End if

			$html .= '<div class="cpb-az-index-alpha-set' . $active . '">';

			if ( ! empty( $alpha_set ) ) {

				$cols = array_chunk( $alpha_set, ceil( count( $alpha_set ) / 3 ) );

				foreach ( $cols as $column => $col_items ) {

					ob_start();

					include __DIR__ . '/az-index.php';

					$html .= ob_get_clean();

				} // End foreach
			} // End if

			$html .= '</div>';

		} // End foreach

		$html .= '</div>';

		return $html;

	} // End get_az_index_content

} // End AZ Index

$cpb_shortcode_az_index = new AZ_Index_Shortcode();
