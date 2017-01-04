<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package themeeo
 */

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}
?>

<div class="col-md-4 widget-area" id="left-sidebar" role="complementary">
<?php dynamic_sidebar( 'left-sidebar' ); ?>

</div><!-- #secondary -->
