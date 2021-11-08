<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Stieller
 */
?>

<aside id="secondary" class="col-12 col-md-5 col-lg-4 col-xl-3 order-md-first">
	<!-- contact details -->
	<table class="d-none d-md-table ms-auto my-3">
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
			<td class="text-end">Pukete, Hamilton</td>
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

	if ( is_front_page() ) :
		dynamic_sidebar( 'sidebar-1' );
	endif;

	?>
</aside><!-- #secondary -->