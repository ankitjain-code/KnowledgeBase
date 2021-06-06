<?php

	/**
	 * Provide a public area view for the plugin
	 *
	 * This file is used to markup the public-facing bookmark category widget
	 *
	 * @link       codeboxr.com
	 * @since      1.0.0
	 *
	 * @package    Cbxwpbookmark
	 * @subpackage Cbxwpbookmark/templates/widgets
	 */
?>
<?php
	// If this file is called directly, abort.
	if ( ! defined( 'WPINC' ) ) {
		die;
	}
?>
<?php
	if ( function_exists( 'cbxbookmark_mycat_html' ) ):
		$display = isset( $instance['display'] ) ? intval( $instance['display'] ) : 0;

		//if display list
		if ( $display == 0 ) {
			echo '<ul class="cbxbookmark-category-list cbxbookmark-category-list-widget cbxbookmark-category-list-' . $bookmark_mode . '">';
		}

		//$instance['allowedit'] = isset($instance['allowedit']) ? intval($instance['allowedit']) : 0;


		echo cbxbookmark_mycat_html( $instance, false );

		//if display list
		if ( $display == 0 ) {
			echo '</ul>';
		}
	endif;