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
<div class="container">
	<header class="row my-3">
		<div class="col-12 col-md-5 col-lg-4 col-xl-3 text-center">
			<?php the_custom_logo(); ?>
		</div>
		<div class="col my-auto">
			<h1 class="display-1 text-uppercase text-center text-md-start"><?php echo str_replace( " ", "<br>", get_bloginfo( 'name' ) ); ?></h1>
		</div>
	</header><!-- #header -->



