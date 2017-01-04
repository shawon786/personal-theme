<?php
/**
 * themeeo Theme Customizer
 *
 * @package themeeo
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'themeeo_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function themeeo_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'themeeo_customize_register' );

if ( ! function_exists( 'themeeo_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function themeeo_theme_customize_register( $wp_customize ) {

		$wp_customize->add_section( 'themeeo_theme_slider_options', array(
			'title' => __( 'Slider Settings', 'themeeo' ),
		) );

		$wp_customize->add_setting( 'themeeo_theme_slider_count_setting', array(
			'default'           => '1',
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'themeeo_theme_slider_count', array(
			'label'    => __( 'Number of slides displaying at once', 'themeeo' ),
			'section'  => 'themeeo_theme_slider_options',
			'type'     => 'text',
			'settings' => 'themeeo_theme_slider_count_setting',
		) );

		$wp_customize->add_setting( 'themeeo_theme_slider_time_setting', array(
			'default'           => '5000',
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'themeeo_theme_slider_time', array(
			'label'    => __( 'Slider Time (in ms)', 'themeeo' ),
			'section'  => 'themeeo_theme_slider_options',
			'type'     => 'text',
			'settings' => 'themeeo_theme_slider_time_setting',
		) );

		$wp_customize->add_setting( 'themeeo_theme_slider_loop_setting', array(
			'default'           => 'true',
			'sanitize_callback' => 'esc_textarea',
		) );

		$wp_customize->add_control( 'themeeo_theme_loop', array(
			'label'    => __( 'Loop Slider Content', 'themeeo' ),
			'section'  => 'themeeo_theme_slider_options',
			'type'     => 'radio',
			'choices'  => array(
				'true'  => 'yes',
				'false' => 'no',
			),
			'settings' => 'themeeo_theme_slider_loop_setting',
		) );

		// Theme layout settings.
		$wp_customize->add_section( 'themeeo_theme_layout_options', array(
			'title'       => __( 'Theme Layout Settings', 'themeeo' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Container width and sidebar defaults', 'themeeo' ),
			'priority'    => 160,
		) );

		$wp_customize->add_setting( 'themeeo_container_type', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'container_type', array(
					'label'       => __( 'Container Width', 'themeeo' ),
					'description' => __( "Choose between Bootstrap's container and container-fluid", 'themeeo' ),
					'section'     => 'themeeo_theme_layout_options',
					'settings'    => 'themeeo_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'themeeo' ),
						'container-fluid' => __( 'Full width container', 'themeeo' ),
					),
					'priority'    => '10',
				)
			) );

		$wp_customize->add_setting( 'themeeo_sidebar_position', array(
			'default'           => 'right',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'themeeo_sidebar_position', array(
					'label'       => __( 'Sidebar Positioning', 'themeeo' ),
					'description' => __( "Set sidebar's position. Can either be: right, left, both or none",
					'themeeo' ),
					'section'     => 'themeeo_theme_layout_options',
					'settings'    => 'themeeo_sidebar_position',
					'type'        => 'select',
					'choices'     => array(
						'right' => __( 'Right sidebar', 'themeeo' ),
						'left'  => __( 'Left sidebar', 'themeeo' ),
						'both'  => __( 'Left & Right sidebars', 'themeeo' ),
						'none'  => __( 'No sidebar', 'themeeo' ),
					),
					'priority'    => '20',
				)
			) );

		// How to display posts index page (home.php).
		$wp_customize->add_setting( 'themeeo_posts_index_style', array(
			'default'           => 'default',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'themeeo_posts_index_style', array(
					'label'       => __( 'Posts Index Style', 'themeeo' ),
					'description' => __( 'Choose how to display latest posts', 'themeeo' ),
					'section'     => 'themeeo_theme_layout_options',
					'settings'    => 'themeeo_posts_index_style',
					'type'        => 'select',
					'choices'     => array(
						'default' => __( 'Default', 'themeeo' ),
						'masonry' => __( 'Masonry', 'themeeo' ),
						'grid'    => __( 'Grid', 'themeeo' ),
					),
					'priority'    => '30',
				)
			) );

		// Columns setup for grid posts.
		/**
		 * Function and callback to check when grid is enabled.
		 *
		 * @return bool
		 */
		function is_grid_enabled() {
			return 'grid' == get_theme_mod( 'themeeo_posts_index_style' );
		}

		// How many columns to use each grid post.
		$wp_customize->add_setting( 'themeeo_grid_post_columns', array(
			'default'    => '6',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'themeeo_grid_post_columns', array(
					'label'       => __( 'Grid Post Columns', 'themeeo' ),
					'description' => __( 'Choose how many columns to use', 'themeeo' ),
					'section'     => 'themeeo_theme_layout_options',
					'settings'    => 'themeeo_grid_post_columns',
					'type'        => 'select',
					'choices' => array(
					'6' => '2',
					'4' => '3',
					'3' => '4',
					'2' => '6',
					'12' => '1',
					),
					'default'     => 2,
					'priority'    => '30',
					'transport'   => 'refresh',
				)
			) );

		// hook to auto-hide/show depending the themeeo_posts_index_style option.
		$wp_customize->get_control( 'themeeo_grid_post_columns' )->active_callback = 'is_grid_enabled';

	}
} // endif function_exists( 'themeeo_theme_customize_register' ).
add_action( 'customize_register', 'themeeo_theme_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'themeeo_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function themeeo_customize_preview_js() {
		wp_enqueue_script( 'themeeo_customizer', get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ), '20130508', true );
	}
}
add_action( 'customize_preview_init', 'themeeo_customize_preview_js' );
