<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package themeeo
 */

get_header();
?>
<div class="wrapper" id="404-wrapper">

	<div class="container" id="content">

		<div class="row">

			<div class="col-md-8 offset-md-2 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<section class="error-404 not-found">

						<header class="page-header">

							<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.',
							'themeeo' ); ?></h1>

						</header><!-- .page-header -->

						<div class="page-content">

							<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?',
							'themeeo' ); ?></p>


							<?php get_search_form(); ?>
							<div class="mt-3"></div>
							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>


						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div> <!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
