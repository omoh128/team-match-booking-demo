<?php
/**
 * Plugin Name:       Team Match Booking Demo
 * Plugin URI:        https://omomohwebsite.com/team-booking-plugin
 * Description:       A frontend-based team match scheduling system for football teams using WordPress.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            Omomoh Agiogu
 * Author URI:        https://omomohwebsite.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       team-match-booking-demo
 * Domain Path:       /languages
 * Update URI:        false
 *
 * @category SportsPress Booking
 * @package TeamMatchBookingDemo
 * @author Omomoh
 * @license GPL v2 or later
 * @link https://github.com/yourhandle/team-match-booking-demo
 * PHP Version 7.4
 */

defined('ABSPATH') or die('No script kiddies please!');

// Autoload classes from vendor or fallback
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

// Activation hook
function activate_team_match_booking_demo() {
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_team_match_booking_demo');

// Deactivation hook
function deactivate_team_match_booking_demo() {
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_team_match_booking_demo');

// Initialize core plugin services
if (class_exists('Inc\\Init')) {
    Inc\Init::registerServices();
}

