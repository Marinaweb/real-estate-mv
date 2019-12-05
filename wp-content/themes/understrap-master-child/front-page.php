<?php
/**
 * The template for displaying front page.
 *
 */
acf_form_head();
get_header();

?>

<div class="wrapper" id="page-wrapper">

	<div class="container" id="content">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">
				
	            <?php the_post();  ?>
	            <?php the_content(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->		
				
	<section id="form_acf" class="container">
		<h2>Добавить новый объект недвижимости:</h2>
		<?php 
		if ( !( is_user_logged_in()  ) ) {?>
		<center><strong>Только зарегистрированные пользователи могут добавить свой рецепт </strong><br /><br /><br />
		Пожалуйста, зарегистрируйтесь или войдите.<br /><br /></center>
		<?php  } else {

			$new_post = array(
				'post_id'            => 'new', 
				'field_groups'       => array(42), 
				'new_post'		     => array(
					'post_type'		=> 'realty'
				),
				'form'               => true,
				'return'             => '%post_url%', 
				'html_before_fields' => '',
				'html_after_fields'  => '',
				'submit_value'       => 'Добавить объект',
				'updated_message'    => 'Сохранено'
			);

			acf_form( $new_post );
		}
		?>
 	</section> <!--#form_acf -->

</div><!-- #page-wrapper -->

<?php get_footer();
