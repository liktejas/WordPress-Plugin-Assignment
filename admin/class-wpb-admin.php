<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://tejassonawane.com
 * @since      1.0.0
 *
 * @package    Wpb
 * @subpackage Wpb/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpb
 * @subpackage Wpb/admin
 * @author     Tejas Sonawane <sonawane.tejas.21@gmail.com>
 */
class Wpb_Admin {

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
		 * defined in Wpb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpb-admin.css', array(), $this->version, 'all' );

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
		 * defined in Wpb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpb-admin.js', array( 'jquery' ), $this->version, false );

	}

	// create menu method
	public function book_menu() {
		add_menu_page( "Booksmenu", "Booksmenu", "manage_options", "books-menu", array( $this, "book_dashboard" ), 'dashicons-book-alt', 76 );
		add_submenu_page( "books-menu", "Settings", "Settings", "manage_options", "books-menu-settings", array( $this, "book_settings" ) );
	}

	// "Booksmenu" menu callback function
	public function book_dashboard() {
		echo "<h3>Welcome to Books Menu</h3>";
	}

	// "Settings" sub-menu callback function
	public function book_settings() {
		echo "<h3>Welcome to Book Setting Page</h3>";
	}

	// create custom post type "book"
	public function custom_post_type_book() {

		$labels = array(
			'name' 					=> 'Book',
			'singular_name' 		=> 'Book',
			'add_new' 				=> 'Add Book',
			'add_new_item' 			=> 'Add New Book',
			'edit_item' 			=> 'Edit Book',
			'new_item' 				=> 'New Book',
			'all_items' 			=> 'All Books',
			'view_item' 			=> 'View Book',
			'search_items' 			=> 'Search Books',
			'not_found' 			=> 'No Books Found',
			'not_found_in_trash' 	=> 'No Books Found in Trash',
			'menu_name' 			=> 'Book',
		);

		$args = array(
			'labels' 			=> $labels,
			'public' 			=> true,
			'publicly_querable' => true,
			'show_ui' 			=> true,
			'show_in_menu' 		=> true,
			'query_var' 		=> true,
			'rewrite' 			=> array( 'slug' => 'book' ),
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hieracrchical' 	=> false,
			'menu_position' 	=> null,
			'supports' 			=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
		);

		register_post_type('Book', $args);
	}


}
