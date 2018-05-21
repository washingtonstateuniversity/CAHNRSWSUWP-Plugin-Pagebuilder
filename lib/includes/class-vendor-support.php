<?php namespace CAHNRSWP\Plugin\Pagebuilder;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to 3rd party support
* @since 3.0.0
*/
class Vendor_Support {

	public function __construct() {

		$this->tribe_events_support();

	} // End __construct


	/**
	 * @desc Add support to tribe events even though it's going away
	 * @since 3.0.5
	 */
	protected function tribe_events_support() {

		add_filter( 'cpb_post_item_array_local_query', array( $this, 'filter_tribe_event_post_item' ), 10, 2 );

	} // End tribe_events_support


	/**
	 * @desc Filter post item for Tribe Events
	 * @since 3.0.5
	 *
	 * @param array $post_item CPB post item
	 * @param WP_Post
	 *
	 * @return array Modified CPB post item
	 */
	public function filter_tribe_event_post_item( $post_item, $post ) {

		if ( 'tribe_events' === $post->post_type ) {

			$start_date = tribe_get_start_date( $post->ID, false, 'M j, Y' );

			$post_item['event_date'] = $start_date;

		} // end if

		return $post_item;

	} // End filter_tribe_event_post_item

} // End Vendor_Support

$vendor_support = new Vendor_Support();
