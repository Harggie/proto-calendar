<?php
// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Proto_Calendar_Event
 */
class Proto_Calendar_Event {

	public function register() {
		add_action( 'init', [ $this, 'register_events_post_type' ] );
		add_action( 'add_meta_boxes_pc_event', [ $this, 'register_meta_box' ] );
		add_action( 'save_post_pc_event', [ $this, 'save_meta_box' ] );
	}

	public function register_events_post_type() {
		register_post_type( 'pc_event', [
			'labels'             => [
				'name' => __( 'Events', PROTO_CALENDAR_TEXT_DOMAIN ),
				'singular_name' => __( 'Event', PROTO_CALENDAR_TEXT_DOMAIN ),
			],
			'public'             => true,
			'publicly_queryable' => true,
			'has_archive'        => true,
			'rewrite'            => [
				'slug' => 'pc-events'
			],
			'supports'           => [
				'title',
				'editor',
				'thumbnail',
				'revisions',
			]
		] );
	}

	public function register_meta_box( $event ) {
		add_meta_box( 'pc_events_meta_box', __( 'Event settings', PROTO_CALENDAR_TEXT_DOMAIN ), [
			$this,
			'create_meta_box'
		] );
	}

	public function create_meta_box( $event ) {
		wp_nonce_field( basename( __FILE__ ), 'pc_events_meta_box_nonce' );

		$date_from = get_post_meta( $event->ID, 'date_from', true );
		$date_to   = get_post_meta( $event->ID, 'date_to', true );

		echo Proto_Calendar_Helpers::render_view( 'view-event-metabox.php', [
			'date_from' => $date_from,
			'date_to'   => $date_to,
		] );
	}

	public function save_meta_box( $event_id ) {

		if ( ! isset( $_POST['pc_events_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['pc_events_meta_box_nonce'], basename( __FILE__ ) ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $event_id ) ) {
			return;
		}

		$save_fields = [ 'date_from', 'date_to' ];

		foreach ( $save_fields as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $event_id, $field, sanitize_text_field( $_POST[ $field ] ) );
			}
		}
	}

}