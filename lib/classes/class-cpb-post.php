<?php namespace CAHNRSWP\Plugin\Pagebuilder;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Object used for posts
* @since 3.0.4
*/
class CPB_Post {

	protected $post_title = '';

	protected $post_content = '';

	protected $post_content_raw = '';

	protected $post_image_array = array(
		'img_src'   => '',
		'img_alt'   => '',
		'img_id'    => '',
	);

	protected $post_excerpt = '';

	protected $post_id = '';

	protected $request_url = '';

	protected $post_type = '';


	/*
	* @desc Build the post from passed data
	* @since 3.0.4
	*
	* @param mixed $post Post data to build from. Eventually could be WP_Post, Post ID, REST Response, REST request query.
	* @param string $context Context to build post from
	* @param array $args Args to pass along to the build
	*/
	public function __construct( $post, $context = 'wp_post', $args = array() ) {

		switch ( $context ) {

			case 'rest-query':
				$this->set_from_rest_query( $post, $context, $args );
				break;
			case 'rest-response':
				$this->set_from_rest_response( $post, $context, $args );
				break;

		} // End switch

	} // End __construct


	/*
	* @desc Get REST response and set from response
	*
	* @param mixed $post Post data to build from. Eventually could be WP_Post, Post ID, REST Response, REST request query.
	* @param string $context Context to build post from
	* @param array $args Args to pass along to the build
	*/
	protected function set_from_rest_query( $post, $context, $args ) {

	} // End set_from_rest_query


	/*
	* @desc Get REST response and set from response
	*
	* @param mixed $post Post data to build from. Eventually could be WP_Post, Post ID, REST Response, REST request query.
	* @param string $context Context to build post from
	* @param array $args Args to pass along to the build
	*/
	protected function set_from_rest_response( $post, $context, $args ) {

		$default_args = array(
			'request_url'   => '',
			'request_base'  => 'wp-json/wp/v2',
			'post_type'     => 'posts',
			'taxonomy'      => 'categories',
			'term_ids'      => array(),
			'count'         => 10,
		);

		$args = array_merge( $default_args, $args );

	} // End set_from_rest_query


} // End CPB_Post
