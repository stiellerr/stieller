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
	<div class="row">
		<main id="primary" class="col">

			<!-- contact details -->
			<table class="ms-auto my-3 d-md-none">
				<tr>
					<td class="text-end"><a href="tel:64275457737">027 545 7737</a></td>
					<td>
						<span class="fa-stack fa-lg">
							<i class="fas fa-circle fa-stack-2x"></i>
							<i class="fas fa-phone fa-stack-1x fa-inverse"></i>
						</span>	
					</td>		
				</tr>
				<tr>
					<td class="text-end"><a href="mailto:reece.stieller@gmail.com">reece.stieller@gmail.com</a></td>
					<td>
						<span class="fa-stack fa-lg">
							<i class="fas fa-circle fa-stack-2x"></i>
							<i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
						</span>
					</td>		
				</tr>
				<tr>
					<td class="text-end">4 Fuchsia Ave, Hamilton</td>
					<td>
						<span class="fa-stack fa-lg">
							<i class="fas fa-circle fa-stack-2x"></i>
							<i class="fas fa-map-marker-alt fa-stack-1x fa-inverse"></i>
						</span>
					</td>
				</tr>
				<tr>
					<td class="text-end"><a href="https://github.com/stiellerr" target="_blank">https://github.com/stiellerr</a></td>
					<td>
						<span class="fa-stack fa-lg">
							<i class="fas fa-circle fa-stack-2x"></i>
							<i class="fab fa-github fa-stack-1x fa-inverse"></i>
						</span>
					</td>		
				</tr>
			</table>

			<?php
			if ( have_posts() ) :
				
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
			endif;
			?>
		</main><!-- #main -->
		<?php get_sidebar(); ?>
	</div>
<?php
get_footer();
