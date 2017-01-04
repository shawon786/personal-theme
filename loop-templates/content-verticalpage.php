<?php
/**
 * The template used for displaying page content in a vertical layout
 * The template modifies Article's ID by using post's slug to lower case as anchor point.
 *
 * @package themeeo
 */

?>
<?php global $post ?>

<article <?php post_class(); ?> id="<?php echo esc_html( strtolower( $post->post_title ) ); ?>">

	<header class="entry-header">

		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'themeeo' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'themeeo' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
