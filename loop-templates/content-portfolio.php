<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package themeeo
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php echo get_the_post_thumbnail( $post->ID, 'portfolio-thumbnail', array('class', 'mb-1') ); ?>
	<header class="entry-header">

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
					<span class="posted-on"><a href="<?php the_permalink(); ?>" rel="bookmark"><time class="entry-date published updated" datetime="<?php echo get_the_date('c');?>"><?php echo get_the_date();?></time></a></span>
			</div><!-- .entry-meta -->

		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
		'</a></h2>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
		the_excerpt();
		?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'themeeo' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php //themeeo_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
