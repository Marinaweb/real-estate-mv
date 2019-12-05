<?php
/**
 * The template for displaying single "city" post type page.
 *
 */


get_header(); ?>

<div class="wrapper" id="single-wrapper">

	<div class="container" id="content">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php the_post(); ?>

				<h1 class="city_title"><?php the_title(); ?></h1>
				<div class="row">
					<div class="col-12 col-xl-5">
						<?php the_content(); ?>
					</div>	

					<div class="col-12 col-xl-7">
						<?php the_post_thumbnail('full'); ?>
					</div>
				</div>
				
				<h2 class="list_title">Объекты недвижимости в городе <?php the_title(); ?></h2>
				
				<div class="realty_wrap row">
					<?php $objects = get_posts(array( 'post_type'=>'realty', 'post_parent'=>$post->ID, 'posts_per_page'=>10, 'orderby'=>'date', 'order'=>'DESC' ));

					if( $objects ){
						global $post; 
						foreach( $objects as $post ){ 
							setup_postdata( $post ); ?>
							<?php get_template_part('loop', 'realty'); ?>
					<?php	}
					}
					else
						echo 'Объектов недвижимости нет...';
					wp_reset_postdata(); ?>
				</div><!-- .realty_wrap -->

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer();

