<?php
// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="event-metabox">
    <h3><?php _e( 'Event begin date', PROTO_CALENDAR_TEXT_DOMAIN ) ?></h3>
    <p>
        <input type="date" name="date_from" value="<?= $options['date_from'] ?>">
    </p>

    <h3><?php _e( 'Event end date', PROTO_CALENDAR_TEXT_DOMAIN ) ?></h3>
    <p>
        <input type="date" name="date_to" value="<?= $options['date_to'] ?>">
    </p>
</div>