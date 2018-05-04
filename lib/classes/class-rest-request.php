<?php namespace CAHNRSWP\Plugin\Pagebuilder;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Object used for posts
* @since 3.0.4
*/
class REST_Request {

	public $response_raw = false;

	public $response_body = false;

	public $response_array = array();

	public $request_query = array();

	public $request_posts = array();

	public $request_args = array(
		'request_type'  => 'post',
		'base_url'      => '',
		'request_base'  => 'wp-json/wp/v2',
		'post_type'     => 'posts',
		'post_id'       => '',
		'taxonomy'      => '',
		'term_ids'      => array(),
		'per_page'         => 10,
		'set_cbp_post'  => true,
		'cache_request' => true,
		'add_embed'     => true,
	);

	/*
	* @desc Build the post from passed data
	* @since 3.0.4
	*
	* @param array $args Args to pass along to the build
	*/
	public function __construct( $args = array() ) {

		$this->request_args = array_merge( $this->request_args, $args );

		switch ( $this->request_args['request_type'] ) {

			case 'post':
				$this->do_post_request();
				break;

		} // End switch

	} // End __construct


	protected function do_post_request() {

		$request_query = array(
			'base_url'       => $this->request_args['base_url'],
			'request_base'   => $this->request_args['request_base'],
			'post_type'      => $this->request_args['post_type'],
			'post_id'        => $this->request_args['post_id'],
			'add_embed'      => $this->request_args['add_embed'],
			'params'         => array(
				'taxonomy'       => $this->request_args['taxonomy'],
				'term_ids'       => $this->request_args['term_ids'],
				'per_page'       => $this->request_args['per_page'],
			),
		);

		$this->request_query = $request_query;

		$request_url = $this->get_request_url();

		$response = wp_remote_get( $request_url );

		if ( is_array( $response ) ) {

			$this->response_raw = $response;

			$this->response_body = wp_remote_retrieve_body( $response );

			$this->response_array = json_decode( $this->response_body, true );

			if ( is_array( $this->response_array ) && $this->request_args['set_cbp_post'] ) {

				include_once cpb_get_plugin_path( '/lib/classes/class-cpb-post.php' );

				foreach ( $this->response_array as $index => $rest_response ) {

					$this->request_posts[] = new CPB_Post( $rest_response, 'rest-response' );

				} // End foreach
			}

		} // End if

	} // End do_post_request


	protected function get_request_url() {

		$url = $this->request_query['base_url'] . '/' . $this->request_query['request_base'] . '/' . $this->request_query['post_type'];

		$query_params = array(
			'per_page' => $this->request_query['params']['per_page'],
		);

		if ( ! empty( $this->request_query['post_id'] ) ) {

			$url .= '/' . $this->request_query['post_id'];

		} elseif ( ! empty( $this->request_query['params']['taxonomy'] ) ) {

			$taxonomy = $this->request_query['params']['taxonomy'];

			$terms = ( is_array( $this->request_query['params']['term_ids'] ) ) ? implode( ',', $this->request_query['params']['term_ids'] ) : $this->request_query['params']['term_ids'];

			$query_params[ $taxonomy ] = $terms;

		}

		$url .= '?' . http_build_query( $query_params );

		if ( ! empty( $this->request_query['add_embed'] ) ) {

			$url .= '&_embed';

		} // End if

		return $url;

	} // End get_request_url


} // End REST_Request
