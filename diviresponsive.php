<?php

/**
 * Responsive Divi Candy
 *
 * @package           Responsive Divi Candy
 * @author            Divi Candy
 * @copyright         2021 Divi Candy
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Responsive Divi Candy
 * Plugin URI:        https://divicandy.com/responsive/
 * Description:       A super lightweight divi plugin that extends Divi with exclusives custom responsive options for mobile and tablet.
 * Version:           1.0.4
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Author:            Divi Candy
 * Author URI:        https://divicandy.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       diviresponsive
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DIVIRESPONSIVE_VERSION', '1.0.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-diviresponsive-activator.php
 */
function activate_diviresponsive() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-diviresponsive-activator.php';
	Diviresponsive_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-diviresponsive-deactivator.php
 */
function deactivate_diviresponsive() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-diviresponsive-deactivator.php';
	Diviresponsive_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_diviresponsive' );
register_deactivation_hook( __FILE__, 'deactivate_diviresponsive' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-diviresponsive.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_diviresponsive() {

	$plugin = new Diviresponsive();
	$plugin->run();

}
run_diviresponsive();
