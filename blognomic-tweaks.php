<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://blognomic.com
 * @since             1.0.0
 * @package           Blognomic_Tweaks
 *
 * @wordpress-plugin
 * Plugin Name:       BlogNomic Tweaks
 * Plugin URI:        https://blognomic.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            BlogNomic players
 * Author URI:        https://blognomic.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       blognomic-tweaks
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
define( 'BLOGNOMIC_TWEAKS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-blognomic-tweaks-activator.php
 */
function activate_blognomic_tweaks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blognomic-tweaks-activator.php';
	Blognomic_Tweaks_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-blognomic-tweaks-deactivator.php
 */
function deactivate_blognomic_tweaks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blognomic-tweaks-deactivator.php';
	Blognomic_Tweaks_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_blognomic_tweaks' );
register_deactivation_hook( __FILE__, 'deactivate_blognomic_tweaks' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-blognomic-tweaks.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_blognomic_tweaks() {

	$plugin = new Blognomic_Tweaks();
	$plugin->run();

}
run_blognomic_tweaks();
