<?php

	/**
	 * Provide a public area view for the plugin
	 *
	 * This file is used to markup the public-facing most bookmark post widget
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
	$attr = array(
		'ul_class' => 'cbxwpbookmark-mostlist-widget',
		'li_class' => '',
	);


	if ( function_exists( 'cbxbookmark_most_html' ) ):
		cbxbookmark_most_html( $instance, $attr, true );
	endif;