<?php
/**
 * Template Name: Home Page
 * @package themeeo
 */

get_header();
?>

<div class="wrapper" id="page-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-3 widget-area" id="left-sidebar" role="complementary">
				<?php //dynamic_sidebar( 'left-sidebar' ); ?>
				<div class="author-avatar">
					<img src="<?php echo get_stylesheet_directory_uri().'/images/sultan-manik.jpg'; ?>" alt="MD Sultan Nasir Uddin">
				</div>

				<?php dynamic_sidebar( 'left-sidebar' ); ?>

				<h4 class="h6 mt-2">Me On Social Sites</h4>
				<ul class="social list-unstyled list-inline">
					<li><a href="https://facebook.com/thisismanik" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<li><a href="https://twitter.com/snumanik" target="_blank"><i class="fa fa-twitter"></i></a></li>
					<li><a href="https://bd.linkedin.com/in/sultannu
" target="_blank"><i class="fa fa-linkedin"></i></a></li>

					<li><a href="https://profiles.wordpress.org/manikmist09/" target="_blank"><i class="fa fa-wordpress"></i></a></li>
					<li><a href="https://github.com/sultann" target="_blank"><i class="fa fa-github"></i></a></li>
				</ul>

			</div><!-- #secondary -->



			<div class="col-md-9 content-area float-lg-right float-md-right" id="primary">

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content', 'page' ); ?>

					<h2 class="h4 mt-3">Recent From Blog</h2>
					<ul>
						<?php
						$posts = get_posts( array(
							'posts_per_page' => 5,
						) );

						if ( $posts ) {
							foreach ( $posts as $post ) :
								setup_postdata( $post );
								?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php
							endforeach;
							wp_reset_postdata();
						}
						?>
					</ul>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
