<?php
// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Proto_Calendar_Shortcode
 */
class Proto_Calendar_Shortcode {
	public function render( $atts ) {

		$output = ( new Proto_Calendar_Base() )->monthly_view();

		return apply_filters( 'proto_calendar_before_shortcode_render', $output );
	}
}