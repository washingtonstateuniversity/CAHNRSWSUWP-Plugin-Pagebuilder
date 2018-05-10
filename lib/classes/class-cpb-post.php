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

	public $post_title = '';

	public $post_content = '';

	public $post_content_raw = '';

	public $post_image_array = array(
		'img_full_src'     => '',
		'img_large_src'    => '',
		'img_medium_src'   => '',
		'img_thumb_src'    => '',
		'img_alt'          => '',
		'img_id'           => '',
	);

	public $post_excerpt = '';

	public $post_id = '';

	public $post_type = '';

	public $post_link = '';


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
	protected function set_from_rest_response( $post, $context, $args ) {

		//var_dump( $post['post_images'] );

		if ( ! empty( $post['title']['rendered'] ) ) {

			$this->post_title = $post['title']['rendered'];

			$this->post_content = $post['content']['rendered'];

			$this->post_excerpt = $post['excerpt']['rendered'];

			$this->post_link = $post['link'];

			$this->post_id = $post['id'];

			// TO DO $post["_embedded"]['wp:featuredmedia'] to handle alt tags

			if ( ! empty( $post['post_images'] ) ) {

				$this->post_image_array = array(
					'img_full_src'     => ( ! empty( $post['post_images']['full'] ) ) ? $post['post_images']['full'] : '',
					'img_large_src'    => ( ! empty( $post['post_images']['large'] ) ) ? $post['post_images']['large'] : '',
					'img_medium_src'   => ( ! empty( $post['post_images']['medium'] ) ) ? $post['post_images']['medium'] : '',
					'img_thumb_src'    => ( ! empty( $post['post_images']['thumbnail'] ) ) ? $post['post_images']['thumbnail'] : '',
					'img_alt'          => '',
					'img_id'           => '',
				);

			} // End if
		} // End if

	} // End set_from_rest_query


} // End CPB_Post
