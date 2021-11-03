<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Stieller
 */
/*
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}*/
?>



<aside id="secondary" class="col-12 col-md-5 col-lg-4 col-xl-3">
	<p>this is a sidebar...</p>	

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->