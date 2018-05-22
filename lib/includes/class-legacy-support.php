<?php namespace CAHNRSWP\Plugin\Pagebuilder;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle legacy support
* @since 3.0.5
*/
class Legacy_Support {


	public function __construct() {

		add_action( 'init', array( $this, 'add_legacy_support' ), 9 );

	} // End __construct


	/*
	* @desc Check if legacy support is enabled and add
	* @since 3.0.5
	*/
	public function add_legacy_support() {

		include_once cpb_get_plugin_path( '/lib/legacy-support/support-1-5-0/support-1-5-0.php' );

	} // End add_legacy_support


} // End Scripts

$cpb_legacy_support = new Legacy_Support();
