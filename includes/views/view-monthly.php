<?php
// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$day_accumulator = $options['first_day'];
?>

<div class="container">
    <table>
        <tr>
			<?php foreach ( $options['headers'] as $day_header ) { ?>
                <th><?= $day_header ?></th>
			<?php } ?>
        </tr>

        <tr>
			<?php for ( $emptyDay = 1; $emptyDay < $options['first_day']; $emptyDay ++ ) { ?>
                <td></td>
			<?php } ?>
			<?php for ( $day = 1; $day <= $options['days_count']; $day ++ ) { ?>

                <td>
                    <div class="<?= ( $day == $options['current_day'] ) ? 'pr-cal-current-day' : 'pr-cal-day' ?>"><?= $day ?></div>
                </td>

				<?php if ( $day_accumulator == 7 ) {
					echo '</tr>';
					if ( ( $day + 1 ) <= $options['days_count'] ) {
						echo '<tr>';
						$day_accumulator = 1;
					}
				} else {
					$day_accumulator ++;
				}
			} ?>
    </table>
</div>