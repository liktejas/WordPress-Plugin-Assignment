<?php

/**
 * Fired during plugin activation
 *
 * @link       https://tejassonawane.com
 * @since      1.0.0
 *
 * @package    Wpb
 * @subpackage Wpb/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wpb
 * @subpackage Wpb/includes
 * @author     Tejas Sonawane <sonawane.tejas.21@gmail.com>
 */
class Wpb_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {
		global $wpdb;
		if( $wpdb->get_var("SHOW tables like '". $this->wpb_bookmeta(). "'" ) != $this->wpb_bookmeta() ) {

			// dynamic generate table
			$table_query = "CREATE TABLE `". $this->wpb_bookmeta() ."` (
								`id` bigint(20) NOT NULL AUTO_INCREMENT,
								`post_id` bigint(20) NOT NULL,
								`author_name` varchar(100) DEFAULT NULL,
								`price` int(11) DEFAULT NULL,
								`publisher` varchar(200) DEFAULT NULL,
								`year` int(11) DEFAULT NULL,
								`edition` varchar(100) DEFAULT NULL,
								`url` varchar(200) DEFAULT NULL,
								PRIMARY KEY (`id`),
								UNIQUE KEY (`post_id`)
							) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
	
			require_once ( ABSPATH.'wp-admin/includes/upgrade.php' );
			dbDelta($table_query);
		}
	}

	public function wpb_bookmeta() {
		global $wpdb;
		return $wpdb->prefix . "bookmeta";
	}

}
