<div class="col-12 col-sm-6 col-md-4 col-lg-3 realty_item">
	<a class="realty_item_img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<ul class="realty_meta">

		<li>Тип недвижимости: 
			<span><?php $cur_terms = get_the_terms( $post->ID, 'realty_type' );
				if( is_array( $cur_terms ) ){
					foreach( $cur_terms as $cur_term ){
						echo '<a href="'. get_term_link( $cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a>';
					}
				} ?> </span>
		</li>

		<?php if( get_field('area') ): ?>
		<li>Площадь: <span><?php the_field('area'); ?> кв.м </span></li>
		<?php endif; ?>

		<?php if( get_field('price') ): ?>
		<li>Стоимость: <span><?php the_field('price'); ?> USD </span></li>
		<?php endif; ?>

		<li>
			<?php global $post;
			$post = get_post( $post->post_parent );
			setup_postdata($post); ?>
			Город:
			<span>
				<a href="<?php the_permalink(); ?>">
					<?php echo $post->post_title . '</a>'; ?>
			</span>	
			<?php wp_reset_postdata(); ?>
		</li>

	</ul><!-- .realty_meta -->
</div><!-- .realty_item -->      

 	