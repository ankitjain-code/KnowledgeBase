<?php

	// Prevent direct file access
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	class CBXWPBookmark_Widget extends WP_Widget {
		/**
		 *
		 * Unique identifier for your widget.
		 *
		 *
		 * The variable name is used as the text domain when internationalizing strings
		 * of text. Its value should match the Text Domain file header in the main
		 * widget file.
		 *
		 * @since    1.0.0
		 *
		 * @var      string
		 */
		protected $widget_slug = 'cbxwpbookmark-widget';

		/**
		 * Constructor
		 *
		 * Specifies the classname and description, instantiates the widget,
		 * loads localization files, and includes necessary stylesheets and JavaScript.
		 */
		public function __construct() {
			parent::__construct(
				$this->get_widget_slug(), esc_html__( 'CBX My Bookmarked Posts', "cbxwpbookmark" ), array(
					'classname'   => 'cbxwpbookmark-mylist-wrap cbxwpbookmark-mylist-wrap-widget '.$this->get_widget_slug() . '-class',
					'description' => esc_html__( 'This widget shows bookmarked posts from a user', "cbxwpbookmark" )
				)
			);
		}// end constructor

		/**
		 * Return the widget slug.
		 *
		 * @return    Plugin slug variable.
		 * @since    1.0.0
		 *
		 */
		public function get_widget_slug() {
			return $this->widget_slug;
		}

		/* -------------------------------------------------- */
		/* Widget API Functions
		  /*-------------------------------------------------- */

		/**
		 * Outputs the content of the widget.
		 *
		 * @param array args  The array of form elements
		 * @param array instance The current instance of the widget
		 */
		public function widget( $args, $instance ) {

			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}

			extract( $args, EXTR_SKIP );


			$widget_string = $before_widget;

			$default_title           = esc_html__( 'My Bookmarks', 'cbxwpbookmark' );
			$instance['honorauthor'] = isset( $instance['honorauthor'] ) ? intval( $instance['honorauthor'] ) : 0;

			if ( is_author() && $instance['honorauthor'] ) {
				$curauth            = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
				$instance['userid'] = $curauth->ID;
				$default_title      = esc_html__( 'Author\'s Bookmarks', 'cbxwpbookmark' );
			}


			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? $default_title : $instance['title'], $instance, $this->id_base );

			if ( $title ) {
				$widget_string .= $args['before_title'] . $title . $args['after_title'];
			} else {
				$widget_string .= $args['before_title'] . $args['after_title'];
			}

			wp_enqueue_style( 'cbxwpbookmarkpublic-css' );



			$instance['loadmore'] = 0; //disable pagination in widget
			$readmore             = isset( $instance['readmore'] ) ? intval( $instance['readmore'] ) : 0; //if show view more link in widget


			$settings_api      = new CBXWPBookmark_Settings_API();
			$mybookmark_pageid = absint( $settings_api->get_option( 'mybookmark_pageid', 'cbxwpbookmark_basics', 0 ) );


			$widget_string .= cbxwpbookmark_get_template_html('widgets/cbxwpbookmark-widget.php', array(
				'instance' => $instance, 'mybookmark_pageid' => $mybookmark_pageid, 'readmore' => $readmore
			));



			$widget_string .= $after_widget;


			print $widget_string;
		}//end widget


		/**
		 * Processes the widget's options to be saved.
		 *
		 * @param array new_instance The new instance of values to be generated via the update.
		 * @param array old_instance The previous instance of values before the update.
		 */
		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title']   = esc_attr( $new_instance['title'] );
			$instance['limit']   = intval( $new_instance['limit'] );
			$instance['orderby'] = esc_attr( $new_instance['orderby'] );
			$instance['order']   = esc_attr( $new_instance['order'] );

			$instance['readmore']    = intval( $new_instance['readmore'] ); //should be loadmore
			$instance['honorauthor'] = intval( $new_instance['honorauthor'] );

			$type = wp_unslash( $new_instance['type'] );  //object type: post, page, custom any post type or custom object type  ->  can be introduced in future
			if ( is_string( $type ) ) {
				$type = explode( ',', $type );
			}

			$type             = array_filter( $type );
			$instance['type'] = $type;

			return $instance;
		}//end update

		/**
		 * Generates the administration form for the widget.
		 *
		 * @param array instance The array of keys and values for the widget.
		 */
		public function form( $instance ) {
			$instance = wp_parse_args(
				(array) $instance,
				array(
					'title'       => esc_html__( 'My Bookmarks', 'cbxwpbookmark' ),
					'limit'       => 10,
					'orderby'     => 'id', //id, object_id, object_type
					'order'       => 'DESC',
					'type'        => array(), //object type, eg, post, page, any custom post type
					'readmore'    => 0, //should be loadmore
					'honorauthor' => 0

				)
			);

			$title   = $instance['title'];
			$limit   = (int) $instance['limit'];
			$orderby = esc_attr( $instance['orderby'] ); //id, object_id, object_type
			$order   = esc_attr( $instance['order'] ); //desc, asc

			$readmore    = intval( $instance['readmore'] );
			$honorauthor = intval( $instance['honorauthor'] );


			$type = wp_unslash( $instance['type'] ); //object_type
			if ( is_string( $type ) ) {
				$type = explode( ',', $type );
			}

			$type = array_filter( $type );
			// Display the admin form
			include( plugin_dir_path( __FILE__ ) . 'views/admin.php' );
		}//end form
	}//end CBXWPBookmark_Widget
