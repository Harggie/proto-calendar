<?php
// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Proto_Calendar_Helpers
 */
class Proto_Calendar_Helpers {

	public static function render_view( $view, $options = []) {
		ob_start();

		include_once PROTO_CALENDAR_ROOT . 'includes/views/' . $view;

		return ob_get_clean();
	}
}