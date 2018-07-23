<?php namespace CAHNRSWP\Plugin\Pagebuilder;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle Shortcodes
* @since 3.0.0
*/
class Shortcodes {


	public function __construct() {

		// Add custom the_content filter
		$this->add_content_filter();

		// Add shrotcodes
		$this->add_shortcodes();

		// Add Registered shortcodes via filter
		\add_action( 'init', array( $this, 'register_shortcodes' ), 99 );

		\add_action( 'init', array( $this, 'check_pre_filter' ), 99 );

	} // End __construct


	/**
	 * @desc Check if set to use pre-filter
	 * @since 3.0.5
	 */
	public function check_pre_filter() {

		if ( get_theme_mod( 'cpb_pre_filter', '' ) ) {

			add_filter( 'the_content', array( $this, 'do_remove_p' ), 1 );

		} // End if

	} // End check_pre_filter


	/*
	* @desc Removes extra p that WordPress likes to add
	* @since 3.0.0
	*
	* @param string $content Post content
	*
	* @return string Post content with shortcodes built out
	*/
	public function do_remove_p( $content ) {

		remove_filter( 'the_content', array( $this, 'do_remove_p' ), 1 );

		$content = do_shortcode( $content );

		return $content;

	} // End do_remove_p


	/*
	* @desc Add custom the_content filters to avoid abuse
	* @since 3.0.0
	*/
	protected function add_content_filter() {

		add_filter( 'cpb_the_content', 'wptexturize' );
		add_filter( 'cpb_the_content', 'convert_smilies' );
		add_filter( 'cpb_the_content', 'convert_chars' );
		add_filter( 'cpb_the_content', 'wpautop' );
		add_filter( 'cpb_the_content', 'shortcode_unautop' );
		add_filter( 'cpb_the_content', 'prepend_attachment' );

	} // End add_content_filter


	/*
	* @desc Register shortcodes use in cpb
	* @since 3.0.0
	*/
	public function register_shortcodes() {

		/*
		* Shortcodes can be added via cpb_shortcode filter or
		* the cpb_register_shortcode() (lib/functions/public.php)  function
		*/
		$register_shortcodes = \apply_filters( 'cpb_shortcodes', array() );

		if ( ! empty( $register_shortcodes ) ) {

			foreach ( $register_shortcodes as $slug => $args ) {

				cpb_register_shortcode( $slug, $args );

			} // End foreach
		} // End if

	} // End add_shortcodes

	/*
	* @desc Add built in Shortcodes
	* @since 3.0.0
	*/
	protected function add_shortcodes() {

		// Add row Shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/row/class-row-shortcode.php' );

		// Add column Shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/column/class-column-shortcode.php' );

		// Add textblock Shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/textblock/class-textblock-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/subtitle/class-subtitle-shortcode.php' );

		// Add action Shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/action/class-action-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/promo/class-promo-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/social/class-social-shortcode.php' );

		// Add Content Feed Shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/content-feed/class-content-feed-shortcode.php' );

		// Add FAQ shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/faq/class-faq-shortcode.php' );

		// Add Figure Caption shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/figure/class-figure-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/image/class-image-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/list/class-list-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/post-gallery/class-post-gallery-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/sidebar/class-sidebar-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/slide/class-slide-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/slideshow/class-slideshow-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/table/class-table-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/video/class-video-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/tabs/class-tabs-shortcode.php' );

		// Add Image shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/az-index/class-az-index-shortcode.php' );

		// Add Banner shortcode
		include_once cpb_get_plugin_path( '/lib/shortcodes/banner/class-banner-shortcode.php' );

	} // End add_shortcodes


} // End Editor

$cpb_shortcodes = new Shortcodes();
