<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://blognomic.com
 * @since      1.0.0
 *
 * @package    Blognomic_Tweaks
 * @subpackage Blognomic_Tweaks/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Blognomic_Tweaks
 * @subpackage Blognomic_Tweaks/admin
 * @author     BlogNomic players <lanny@blognomic.com>
 */
class Blognomic_Tweaks_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Blognomic_Tweaks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Blognomic_Tweaks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/blognomic-tweaks-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Blognomic_Tweaks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Blognomic_Tweaks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/blognomic-tweaks-admin.js', array( 'jquery', 'post' ), $this->version, false );

	}

	public function expose_site_tagline($wp_customize) {
		$setting = $wp_customize->get_setting('blogdescription');

		if(!empty($setting)) {
			$setting->capability = 'edit_others_posts';
		}

		return $wp_customize;
	}

}
