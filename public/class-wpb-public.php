<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://tejassonawane.com
 * @since      1.0.0
 *
 * @package    Wpb
 * @subpackage Wpb/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wpb
 * @subpackage Wpb/public
 * @author     Tejas Sonawane <sonawane.tejas.21@gmail.com>
 */
class Wpb_Public {

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
		 * defined in Wpb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpb-public.css', array(), $this->version, 'all' );

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
		 * defined in Wpb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpb-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Returns the information of book to shortcode named book.
	 *
	 * @since    1.0.0
	 * @param      array    $atts       Contains the attributes passed in shortcode
	 */
	public function load_book_content( $atts ) {
		// print_r($atts);
		global $wpdb;
		$id = esc_html( $atts['id'] );
		$data = $wpdb->get_row( "SELECT wp_bookmeta.author_name, wp_bookmeta.price, wp_bookmeta.publisher, wp_bookmeta.year, wp_bookmeta.edition, wp_bookmeta.url, wp_posts.post_title, wp_posts.post_content FROM wp_bookmeta INNER JOIN wp_posts ON wp_posts.ID = wp_bookmeta.post_id WHERE wp_posts.ID = $id", 'ARRAY_A' );
		if ( $wpdb->num_rows > 0 ) {
			// print_r();
			// exit();
			ob_start();
			?>
			<div>
				<h3 style="text-align:center"><?php echo esc_html( $data['post_title'] ) ?></h3>
				<p style="text-align:justify"><?php echo esc_html( $data['post_content'] ) ?></p>
				<table>
					<tbody>
						<tr>
							<td><p>Price: &#8377; <?php echo esc_html( $data['price'] ) ?></p></td>
							<td><p>Publisher: <?php echo esc_html( $data['publisher'] ) ?></p></td>
						</tr>
						<tr>
							<td><p>Year: <?php echo esc_html( $data['year'] ) ?></p></td>
							<td><p>Edition: <?php echo esc_html( $data['edition'] ) ?></p></td>
						</tr>
						<tr>
							<td colspan="2"><p style="text-align:center">For more information: <a href="<?php echo esc_attr( $data['url'] ) ?>" target="_blank"><?php echo esc_attr( $data['url'] ) ?></p></td>
						</tr>	
					</tbody>
				</table>
			</div>
			<?php
			$contents = ob_get_contents();
			ob_get_clean();
			return $contents;
		}
	}

}
