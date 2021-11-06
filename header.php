<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Stieller
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="container my-3">
	<header class="row">
		<div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 text-center pt-md-5">
			<?php the_custom_logo(); ?>
		</div>
		<div class="col">
			<div class="h-100 d-sm-flex align-items-center">
				<h1 class="display-1 text-uppercase text-center text-md-start mb-0 mt-3 mt-sm-0"><?php echo str_replace( " ", "<br>", get_bloginfo( 'name' ) ); ?></h1>
			</div>
		</div><!-- -->
	</header><!-- #header -->



