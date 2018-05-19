<?php
// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Proto_Calendar_Base
 */
class Proto_Calendar_Base {

	public function monthly_view() {

		$current_year  = date( 'Y' );
		$current_month = date( 'n' );
		$current_day   = date( 'j' );
		$first_day     = date( 'N', mktime( 0, 0, 0, $current_month, 1, $current_year ) );
		$days_in_month = date( 't', mktime( 0, 0, 0, $current_month, 1, $current_year ) );

		return Proto_Calendar_Helpers::render_view( 'view-monthly.php', [
			'headers'    => $this->available_days(),
			'days_count' => $days_in_month,
			'first_day'  => $first_day,
			'current_day' => $current_day,
		] );
	}

	private function available_days() {
		return [
			__( 'Mon', PROTO_CALENDAR_TEXT_DOMAIN ),
			__( 'Tue', PROTO_CALENDAR_TEXT_DOMAIN ),
			__( 'Wed', PROTO_CALENDAR_TEXT_DOMAIN ),
			__( 'Thu', PROTO_CALENDAR_TEXT_DOMAIN ),
			__( 'Fri', PROTO_CALENDAR_TEXT_DOMAIN ),
			__( 'Sat', PROTO_CALENDAR_TEXT_DOMAIN ),
			__( 'Sun', PROTO_CALENDAR_TEXT_DOMAIN ),
		];
	}
}