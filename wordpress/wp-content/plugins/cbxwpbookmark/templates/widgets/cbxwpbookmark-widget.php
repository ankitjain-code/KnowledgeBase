<?php

	/**
	 * Provide a public area view for the plugin
	 *
	 * This file is used to markup the public-facing bookmark post widget
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

	if ( function_exists( 'cbxbookmark_post_html' ) ):
		echo '<ul class="cbxwpbookmark-mylist cbxwpbookmark-mylist-widget">';
		echo cbxbookmark_post_html( $instance, false );

		//if read more shown and logged in user then show his readmore link
		if ( $readmore && get_current_user_id() > 0 ) {
			echo ( $mybookmark_pageid > 0 ) ? '<li class="cbxwpbookmark-mylist-item cbxwpbookmark-mylist-item-readmore"> <a href="' . esc_url( cbxwpbookmarks_mybookmark_page_url() ) . '" class="cbxlbjs-item-widget" >' . esc_html__( ' View All', 'cbxwpbookmark' ) . '</a></li>' : '';
		}

		echo '</ul>';

	endif;