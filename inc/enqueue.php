<?php
/**
 * themeeo enqueue scripts
 *
 * @package themeeo
 */

if ( ! function_exists( 'themeeo_scripts' ) ) {
	/**
	 * Load theme's JavaScript sources.
	 */
	function themeeo_scripts() {
		// Get the theme data
		$the_theme = wp_get_theme();
		wp_enqueue_style( 'themeeo-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), $the_theme->get( 'Version' ) );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'themeeo-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $the_theme->get( 'Version' ), true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'themeeo_scripts' ).

add_action( 'wp_enqueue_scripts', 'themeeo_scripts' );

/**
 *Loading slider script conditionally
 */

if ( is_active_sidebar( 'hero' ) ) :
	add_action( 'wp_enqueue_scripts', 'themeeo_slider' );

	if ( ! function_exists( 'themeeo_slider' ) ) {
		/**
		 * Setup slider.
		 */
		function themeeo_slider() {
			if ( is_front_page() ) {
				$data = array(
					'timeout' => intval( get_theme_mod( 'themeeo_theme_slider_time_setting', 5000 ) ),
					'items'   => intval( get_theme_mod( 'themeeo_theme_slider_count_setting', 1 ) ),
				);

				wp_enqueue_script( 'themeeo-slider-script',
				get_stylesheet_directory_uri() . '/js/slider_settings.js', array() );
				wp_localize_script( 'themeeo-slider-script', 'themeeo_slider_variables', $data );
			}
		}
	}
endif;

