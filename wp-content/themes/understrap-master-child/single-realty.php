<?php
/**
 * The template for displaying single "realty" post type page.
 *
 */


get_header(); ?>

<div class="wrapper" id="single-wrapper">

	<div class="container" id="content">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php the_post();  ?>

				<h1><?php the_title(); ?></h1>

				<div class="row">

					<!-- slider start -->
					<?php
					// check if the nested repeater field has rows of data
					if( have_rows('images_realty') ):

					echo '<div class="col-12 col-lg-6 slick_main">';

					// loop through the rows of data
					while ( have_rows('images_realty') ) : the_row(); ?>

					<?php $image_slide = get_sub_field('img_item'); ?>

					<img src="<?php echo $image_slide['url']; ?>">

					<?php endwhile;

					echo '</div>'; //.slick_main
					endif; ?>
					<!-- slider end -->


					<table class="col-12 col-lg-6 table_realty" border="1" bgcolor="#53f" cellpadding="10" width="800px;" rules="rows" >

						<!-- Realty type - taxonomy -->
						<tr>
							<td>Тип недвижимости</td>
							<td>
								<?php $cur_terms = get_the_terms( $post->ID, 'realty_type' );
								if( is_array( $cur_terms ) ){
									foreach( $cur_terms as $cur_term ){
										echo '<a href="'. get_term_link( $cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a>';
									}
								} ?> 
							</td>
						</tr>
						<!-- Realty type end -->

						<!-- Area ACF -->
						<?php if( get_field('area') ): ?>
						<tr>
							<td>Площадь</td>
							<td><?php the_field('area'); ?> кв.м </td>
						</tr>
						<?php endif; ?>
						<!-- Area ACF end -->

						<!-- Price ACF -->
						<?php if( get_field('price') ): ?>
						<tr>
							<td>Стоимость</td>
							<td><?php the_field('price'); ?> USD</td>
						</tr>					    
						<?php endif; ?>
						<!-- Price ACF end-->

						<!-- City - CPT "city" -->
						<?php global $post;
						$post = get_post( $post->post_parent );
						setup_postdata($post); ?>

						<tr>
							<td>Город</td>
							<td>
								<a href="<?php the_permalink(); ?>">
									<?php echo $post->post_title . '</a>'; ?>
									</td>
						</tr>	

						<?php wp_reset_postdata(); ?>
						<!-- City - CPT "city" end -->

						<!-- Address ACF -->
						<?php if( get_field('address') ): ?>
						<tr>
							<td>Адрес</td>
							<td><?php the_field('address'); ?></td>
						</tr>						    
						<?php endif; ?>
						<!-- Address ACF end -->

						<!-- Live area ACF -->
						<?php if( get_field('live_area') ): ?>
						<tr>
							<td>Жилая площадь</td>
							<td><?php the_field('live_area'); ?> кв.м</td>
						</tr>						    
						<?php endif; ?>
						<!-- Live area ACF end -->

						<!-- Floor ACF -->
						<?php if( get_field('floor') ): ?>
						<tr>
							<td>Этаж</td>
							<td><?php the_field('floor'); ?></td>
						</tr>						    
						<?php endif; ?>
						<!-- Floor ACF end -->

					</table> 

				</div><!-- .row -->

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer();

