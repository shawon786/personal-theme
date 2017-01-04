<?php
/**
 * Check and setup theme's default settings
 */
function setup_theme_default_settings() {

	// check if settings are set, if not set defaults.
	// Caution: DO NOT check existence using === always check with == .
	// Latest blog posts style.
	$themeeo_posts_index_style = get_theme_mod( 'themeeo_posts_index_style' );
	if ( '' == $themeeo_posts_index_style ) {
		set_theme_mod( 'themeeo_posts_index_style', 'default' );
	}

	// Sidebar position.
	$themeeo_sidebar_position = get_theme_mod( 'themeeo_sidebar_position' );
	if ( '' == $themeeo_sidebar_position ) {
		set_theme_mod( 'themeeo_sidebar_position', 'right' );
	}

	// Container width.
	$themeeo_container_type = get_theme_mod( 'themeeo_container_type' );
	if ( '' == $themeeo_container_type ) {
		set_theme_mod( 'themeeo_container_type', 'container' );
	}
}
