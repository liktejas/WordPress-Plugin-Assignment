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
			'labels' 				=> $labels,
			'public' 				=> true,
			'publicly_querable' 	=> true,
			'show_ui' 				=> true,
			'show_in_menu' 			=> true,
			'query_var' 			=> true,
			'rewrite' 				=> array( 'slug' => 'book' ),
			'capability_type' 		=> 'post',
			'has_archive' 			=> true,
			'hieracrchical' 		=> false,
			'menu_position' 		=> null,
			'supports' 				=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
		);

		register_post_type('Book', $args);
	}

	// create custom hierarchical category book
	public function custom_category_book() {

		$labels = array(
			'name'                       => _x( 'Book Categories', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Book Category', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Book Category', 'text_domain' ),
			'all_items'                  => __( 'All Items', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'Add Book Category', 'text_domain' ),
			'add_new_item'               => __( 'Add New Book Category', 'text_domain' ),
			'edit_item'                  => __( 'Edit Book Category', 'text_domain' ),
			'update_item'                => __( 'Update Book Category', 'text_domain' ),
			'view_item'                  => __( 'View Book Category', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Items', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No items', 'text_domain' ),
			'items_list'                 => __( 'Items list', 'text_domain' ),
			'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		
		register_taxonomy( 'Book Category', array( 'post' ), $args );
	}


	// Register Custom Non-Hierarchical Taxonomy Book Tag
	function custom_tag_book() {

		$labels = array(
			'name'                       => _x( 'Book Tags', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Book Tag', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Book Tag', 'text_domain' ),
			'all_items'                  => __( 'All Book Tags', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'Add Book Tag', 'text_domain' ),
			'add_new_item'               => __( 'Add New Book Tag', 'text_domain' ),
			'edit_item'                  => __( 'Edit Book Tag', 'text_domain' ),
			'update_item'                => __( 'Update Book Tag', 'text_domain' ),
			'view_item'                  => __( 'View Book Tag', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Items', 'text_domain' ),
			'search_items'               => __( 'Search Book Tag', 'text_domain' ),
			'not_found'                  => __( 'Not Book Tag Found', 'text_domain' ),
			'no_terms'                   => __( 'No items', 'text_domain' ),
			'items_list'                 => __( 'Items list', 'text_domain' ),
			'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
		);
		
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy( 'Book Tag', array( 'post' ), $args );
	}

	public function custom_metabox_books() {
		// for page, post and custom post type
		add_meta_box('custom-books-info', 'Books Info', array( $this, "custom_books_info_function" ), array( 'page', 'post', 'Book' ) );
	}

	public function custom_books_info_function() {
		wp_nonce_field( basename( __FILE__ ), 'custom_books_info_nonce' );
		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="wpb-custom-author-name">Author Name</label></th>
					<td><input name="wpb-custom-author-name" type="text" id="wpb-custom-author-name" placeholder="Author Name" class="regular-text"></td>
				</tr>
				<tr>
					<th scope="row"><label for="wpb-custom-price">Book Price</label></th>
					<td><input name="wpb-custom-price" type="text" id="wpb-custom-price" placeholder="Book Price" class="regular-text"></td>
				</tr>
				<tr>
					<th scope="row"><label for="wpb-custom-publisher">Publisher</label></th>
					<td><input name="wpb-custom-publisher" type="text" id="wpb-custom-publisher" placeholder="Publisher" class="regular-text"></td>
				</tr>
				<tr>
					<th scope="row"><label for="wpb-custom-year">Year</label></th>
					<td><input name="wpb-custom-year" type="number" id="wpb-custom-year" placeholder="Year" class="regular-text"></td>
				</tr>
				<tr>
					<th scope="row"><label for="wpb-custom-edition">Edition</label></th>
					<td><input name="wpb-custom-edition" type="text" id="wpb-custom-edition" placeholder="Edition" class="regular-text"></td>
				</tr>
				<tr>
					<th scope="row"><label for="wpb-custom-url">URL</label></th>
					<td><input name="wpb-custom-url" type="url" id="wpb-custom-url" placeholder="URL eg. https://example.com" class="regular-text"></td>
				</tr>
			</tbody>
		</table>
		<?php
	}
}
