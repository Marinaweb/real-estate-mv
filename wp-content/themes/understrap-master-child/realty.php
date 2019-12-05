<?php
/**
Template Name: realty
 * The template for displaying realty CPT page.
 *
 */

get_header();

?>

<div class="wrapper" id="page-wrapper">

	<div class="container" id="content">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">
				
				<h1><?php the_title(); ?></h1>
	            <?php the_post();  ?>
				<?php the_content(); ?>
				
				<div class="realty_wrap row">
	            <?php 
	                $args = array(
	                    'post_type' => 'realty', 
						'orderby'   => 'date',
						'order'     => 'DESC'
	                );
	                $loop = new WP_Query($args); 

	              	if( $loop->have_posts() ):
	                    while( $loop->have_posts() ): $loop->the_post(); 
	            	?>
					
					<?php get_template_part('loop', 'realty'); ?>
					
					<?php endwhile; ?>
					<?php else: ?>
					<?php endif;
						wp_reset_postdata(); 
					?>			
			
                </div><!-- .realty_wrap -->

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer();
