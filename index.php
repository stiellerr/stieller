<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Stieller
 */

get_header();
?>
<!--
	<div class="container">
		<div class="row">
			<div class="col-3">
				<figure>
					<?php /*the_custom_logo();*/ ?>
				</figure>

    		</div>
    		<div class="col my-auto">
      			<h1 class="display-1 text-uppercase">Reece<br>Stieller<h1>
    		</div>
  		</div>
		  <div class="row">
			<div class="col-3">
			<div class="text-end">
					<a class="">027 545 7737</a>
				</div>
    		</div>
    		<div class="col my-auto">
				<h4>PROFILE</h4>
				<hr>
				<p class="text-justify">Senior control systems engineer with 12+ years’ experience developing and maintaining software and IT infrastructure for industrial applications.</p>
				<p class="text-justify">Strong communication and technical background. Driven by roles that are challenging, varied & interesting that require me to apply my problemsolving skills.</p>
				<p class="text-justify pb-4">Maintains a natural aptitude for working under pressure and managing multiple workloads, strong work ethic and a relentless passion to learn and develop for ongoing growth.</p>
				
				<h4 class="text-uppercase">Work Experience</h4>
				<hr>
				<h6 class="text-uppercase fw-bold">control systems engineer</h6>
				<p class="fst-italic">Fonterra Co-Op Ltd / April 2011 – Present</p>
				<ul class="text-justify">
					<li>Providing control systems software and IT support to production, maintenance and project teams to ensure the continuous up time of operations</li>
					<li>Fault finding, breakdowns and after hours standby duties</li>
					<li>Software changes, improvements & upgrades</li>
					<li>Ongoing maintenance of IT infrastructure & database’s</li>
					<li>Development & maintenance of web applications/ intranet</li>
					<li>Coaching and mentoring of junior staff, electricians and interns</li>
					<li>Effective communication of technical language with nontechnical stakeholders</li>
					<li>Software & hardware design</li>
					<li>Project management</li>

				</ul>
			
			</div>
  		</div>
	</div>-->

	<!--<main id="primary" class="site-main">
	<div class="container">-->
		<div class="row my-md-3">

			<?php get_sidebar(); ?>
	
			<main id="primary" class="col">

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
						<!--
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
						-->
						<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						the_content();
						/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
						//get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

			</main><!-- #main -->
		</div>
<?php

get_footer();
