<?php
/**
Template Name: city
 * The template for displaying city CPT page.
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

	            <div class="city_wrap row">
	            <?php 
	                $args = array(
	                    'post_type' => 'city', 
	                    'orderby'   => 'title',
						'order'     => 'ASC'
	                );
	                $loop = new WP_Query($args);

	                if( $loop->have_posts() ):
	                    while( $loop->have_posts() ): $loop->the_post(); 
	            ?>

	            	<div class="col-md-12 col-lg-6 city_item">
	            		<a class="city_item_img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
	            		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	            	</div><!-- .city_item -->      

                <?php endwhile; ?>
	            <?php else: ?>
	            <?php endif;
	                wp_reset_postdata(); 
	            ?>
                </div><!-- .city_wrap -->

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer();
