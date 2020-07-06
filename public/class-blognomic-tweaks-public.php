<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://blognomic.com
 * @since      1.0.0
 *
 * @package    Blognomic_Tweaks
 * @subpackage Blognomic_Tweaks/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Blognomic_Tweaks
 * @subpackage Blognomic_Tweaks/public
 * @author     BlogNomic players <lanny@blognomic.com>
 */
class Blognomic_Tweaks_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/blognomic-tweaks-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/blognomic-tweaks-public.js', array( 'jquery' ), $this->version, false );

	}

	public function dynamic_tags($dynamic_tags) {
		include_once __DIR__ . '/partials/class-blognomic-tweaks-post-classes-dynamic-tag.php';
		include_once __DIR__ . '/partials/class-blognomic-tweaks-title-with-category-dynamic-tag.php';
		include_once __DIR__ . '/partials/class-blognomic-tweaks-title-with-category-and-tags-dynamic-tag.php';
		include_once __DIR__ . '/partials/class-blognomic-tweaks-title-with-tags-only-dynamic-tag.php';
		$dynamic_tags->register_tag('BlogNomic_Post_Classes_Tag');
		$dynamic_tags->register_tag('BlogNomic_Title_With_Category_Tag');
		$dynamic_tags->register_tag('BlogNomic_Title_With_Category_And_Tags_Tag');
		$dynamic_tags->register_tag('BlogNomic_Title_With_Tags_Only_Tag');
	}

	public function shortcode_clock() {
		return sprintf('<span class="blognomic-clock">%s UTC</span>', gmdate('l, F j, Y · H:i:s'));
	}

	public function current_active_players_widget() {
		include_once __DIR__ . '/partials/class-blognomic-tweaks-current-active-players-widget.php';
		register_widget('BlogNomic_Tweaks_Current_Active_Players_Widget');
	}

	public function post_info_including_closed_comments_elementor_widget() {
		include_once __DIR__ . '/partials/class-blognomic-tweaks-post-info-including-closed-comments-elementor-widget.php';
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorPro\Modules\ThemeElements\Widgets\Post_Info_Including_Closed_Comments() );
	}

}
