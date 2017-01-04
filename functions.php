<?php
/**
 * themeeo functions and definitions
 *
 * @package themeeo
 */

/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load functions to secure your WP install.
 */
require get_template_directory() . '/inc/security.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
 * Load WooCommerce functions.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load a utilities library.
 */
require get_template_directory() . '/inc/utilities.php';



function register_portfolio() {
	$labels = array(
		'name'           => _x( 'Portfolio', 'post type general name', 'pluginever' ),
		'singular_name'  => _x( 'Portfolio', 'post type singular name', 'pluginever' ),
		'menu_name'      => _x( 'Portfolios', 'admin menu', 'pluginever' ),
		'name_admin_bar' => _x( 'Portfolios', 'add new on admin bar', 'pluginever' ),
		'add_new'        => _x( 'Add Portfolio', 'Portfolio', 'pluginever' ),
		'add_new_item'   => __( 'Add New Portfolio', 'pluginever' ),
		'new_item'       => __( 'New Portfolio', 'pluginever' ),
		'edit_item'      => __( 'Edit Portfolio', 'pluginever' ),
		'view_item'      => __( 'View Portfolio', 'pluginever' ),
		'all_items'      => __( 'All Portfolios', 'pluginever' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'pluginever' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'taxonomies' => array('post_tag'),
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title','editor', 'thumbnail')
	);

	register_post_type( 'portfolio', $args );
}

add_action( 'init', 'register_portfolio',0 );


//add_action( 'init', 'create_tag_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function create_tag_taxonomies()
{
	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name' => _x( 'Tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Tags' ),
		'popular_items' => __( 'Popular Tags' ),
		'all_items' => __( 'All Tags' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Tag' ),
		'update_item' => __( 'Update Tag' ),
		'add_new_item' => __( 'Add New Tag' ),
		'new_item_name' => __( 'New Tag Name' ),
		'separate_items_with_commas' => __( 'Separate tags with commas' ),
		'add_or_remove_items' => __( 'Add or remove tags' ),
		'choose_from_most_used' => __( 'Choose from the most used tags' ),
		'menu_name' => __( 'Tags' ),
	);

	register_taxonomy('tag','portfolio',array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'tag' ),
	));
}