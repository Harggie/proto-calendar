<?php
/**
 * Plugin Name:       Proto Calendar
 * Description:       Simple, monthly view calendar plugin
 * Version:           0.0.1
 * Author:            Damian Konieczny
 * Text Domain:       proto-calendar
 * Domain Path:       /languages
 */

// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Proto_Calendar_Plugin
 */
class Proto_Calendar_Plugin {

	private $shortcode = 'proto_calendar';

	public function run() {
		$self = new self();
		$self->init();
	}

	public function init() {

		define( 'PROTO_CALENDAR_ROOT', plugin_dir_path( __FILE__ ) );
		define( 'PROTO_CALENDAR_TEXT_DOMAIN', 'proto-calendar' );

		require_once PROTO_CALENDAR_ROOT . 'includes/classes/class-proto-calendar-base.php';
		require_once PROTO_CALENDAR_ROOT . 'includes/classes/class-proto-calendar-shortcode.php';
		require_once PROTO_CALENDAR_ROOT . 'includes/classes/class-proto-calendar-helpers.php';
		require_once PROTO_CALENDAR_ROOT . 'includes/classes/class-proto-calendar-event.php';

		// Load the text domain
		add_action( 'init', [ $this, 'load_textdomain' ] );

		// Register custom post type
		( new Proto_Calendar_Event() )->register();

		// Load styles
		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );

		// Load the shortcode
		add_shortcode( $this->shortcode, [ $this, 'shortcode' ] );

	}

	public function load_textdomain() {
		load_plugin_textdomain( 'proto-calendar', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	public function register_styles() {
		wp_enqueue_style( 'proto-calendar', plugins_url( 'assets/css/proto-calendar.css', __FILE__ ) );
	}

	public function shortcode( $atts ) {
		return ( new Proto_Calendar_Shortcode() )->render( $atts );
	}
}

( new Proto_Calendar_Plugin() )->run();
