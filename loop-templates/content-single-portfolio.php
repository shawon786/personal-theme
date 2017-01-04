<?php
/**
 * Single post partial template.
 *
 * @package themeeo
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header text-xs-center">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<span class="posted-on"><time class="entry-date published updated" datetime="<?php echo get_the_date('c');?>"><?php echo get_the_date();?></time></span>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>
		<?php
		$tags_list = get_the_tag_list( '', __( ', ', 'themeeo' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'themeeo' ) . '</span>', $tags_list );
		}
		?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'themeeo' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php themeeo_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
