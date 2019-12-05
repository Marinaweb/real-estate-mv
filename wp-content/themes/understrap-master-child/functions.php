<?php
/**
 * Child functions.php
 *
 */

/**
 * Enqueue child theme css.
 */
function understrap_master_child_enqueue_styles() {
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_register_style( 'slick-my', get_stylesheet_directory_uri()  . '/components/slick/slick.css' );
    wp_enqueue_style( 'slick-my' );
}
add_action( 'wp_enqueue_scripts', 'understrap_master_child_enqueue_styles' );


/**
 * Enqueue child theme scripts.
 */
function understrap_master_child_scripts() {  

    wp_register_script( 'custom', get_stylesheet_directory_uri() . '/custom.js', array( 'jquery' ) );
    wp_enqueue_script( 'custom' );
    wp_register_script( 'slick.min', get_stylesheet_directory_uri() . '/components/slick/slick.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'slick.min' );
}

    add_action( 'wp_enqueue_scripts', 'understrap_master_child_scripts' );


/**
 * Custom Post Type - realty
 */

function realty_custom_post_type (){

    $labels = array(
        'name' => 'Недвижимость',
        'singular_name' => 'Недвижимость',
        'add_new' => 'Добавить объект',
        'all_items' => 'Все объекты',
        'add_new_item' => 'Добавить объект',
        'edit_item' => 'Редактировать',
        'new_item' => 'Новый объект',
        'view_item' => 'Просмотр',
        'search_item' => 'Поиск',
        'non_found' => 'Ничего не найдено',
        'not_found_in_trash' => 'Ничего не найдено в корзине',
        'parent_item_colon' => 'Родительский элемент'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
                'title',
                'thumbnail',
            ),
        'menu_position' => 5,
        'exclude_from_search' => false
    );
    register_post_type('realty',$args); 
}
add_action('init','realty_custom_post_type');


/**
 * Custom Taxonomies - realty-type
 */

function custom_taxonomies_realty_type() {

    $labels = array(
        'name' => 'Тип недвижимости',
        'singular_name' => 'Тип недвижимости',
        'search_items' => 'Поиск',
        'all_items' => 'Все',
        'parent_item' => 'Родительский элемент',
        'parent_item_colon' => 'Тип родителя:',
        'edit_item' => 'Редактировать',
        'update_item' => 'Обновить',
        'add_new_item' => 'Добавить новый',
        'new_item_name' => 'Новый',
        'menu_name' => 'Тип недвижимости'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'realty_type')
    );

    register_taxonomy('realty_type', array('realty'), $args);
	
}
add_action( 'init', 'custom_taxonomies_realty_type');

/**
 * Custom Post Type - city
 */

function city_custom_post_type (){

    $labels = array(
        'name' => 'Города',
        'singular_name' => 'Город',
        'add_new' => 'Добавить город',
        'all_items' => 'Все города',
        'add_new_item' => 'Добавить город',
        'edit_item' => 'Редактировать',
        'new_item' => 'Новый город',
        'view_item' => 'Просмотр',
        'search_item' => 'Поиск',
        'non_found' => 'Ничего не найдено',
        'not_found_in_trash' => 'Ничего не найдено в корзине',
        'parent_item_colon' => 'Родительский элемент'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
        'menu_position' => 6,
        'exclude_from_search' => false
    );
    register_post_type('city',$args); 
}
add_action('init','city_custom_post_type');




// To add metabox for city choosing to realty object
add_action('add_meta_boxes', function () {
	add_meta_box( 'custom_city', 'Город', 'custom_city_metabox', 'realty', 'side', 'low'  );
}, 1);

// metabox with city select
function custom_city_metabox( $post ){
	$cities = get_posts(array( 'post_type'=>'city', 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));

	if( $cities ){
		echo '<ul>';

			foreach( $cities as $city ){
				echo '
				<li><label>
					<input type="radio" name="post_parent" value="'. $city->ID .'" '. checked($city->ID, $post->post_parent, 0) .'> '. esc_html($city->post_title) .'
				</label></li>
				';
			}

		echo '</ul>';
	}
	else
		echo 'Городов нет';
}



// checking
add_action('add_meta_boxes', function(){
	add_meta_box( 'objects', 'Объекты недвижимости', 'objects_metabox', 'city', 'side', 'low'  );
}, 1);

function objects_metabox( $post ){
	$objects = get_posts(array( 'post_type'=>'realty', 'post_parent'=>$post->ID, 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));

	if( $objects ){
		foreach( $objects as $object ){
			echo $object->post_title .'<br>';
		}
	}
	else
		echo 'Объектов нет';
}



/**
 * Add shortcode for realty cpt 
 */
add_shortcode( 'realty', 'realty_posts', 100 );
function realty_posts(){
	$args = array(
		'post_type' => 'realty', 
		'orderby'   => 'date',
		'order'     => 'DESC',
		'posts_per_page' => 8
	);
	$loop = new WP_Query($args); 
	 $content = '';

	 if( $loop->have_posts() ){
	 $content .= '<div class="realty_wrap row">';
	 while( $loop->have_posts() ){
	 $loop->the_post();
		 
		 
	 	$content .= '<div class="col-12 col-sm-6 col-md-4 col-lg-3 realty_item">';
			$content .= '<a class="realty_item_img" href="' . get_the_permalink() . '">' .  get_the_post_thumbnail() .'</a>';
			$content .= '<h2><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';

			$content .= '<ul class="realty_meta">';
		 
				$content .= '<li>Тип недвижимости: ';
					$content .= '<span>';
					$cur_terms = get_the_terms( $post->ID, "realty_type" );
							if( is_array( $cur_terms ) ){
								foreach( $cur_terms as $cur_term ){
									$content .= '<a href="'. get_term_link( $cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a>';
								}
							} 
					$content .= ' </span>';
				$content .= '</li>';

				if( get_field('area') ): 
				$content .= '<li>Площадь: <span>' . get_field("area") . ' кв.м </span></li>';
				endif;

				if( get_field('price') ): 
				$content .= '<li>Стоимость: <span>' . get_field("price") . ' USD </span></li>';
				endif; 

				$content .= '<li>';
				global $post;
				$post = get_post( $post->post_parent );
				setup_postdata($post); 

					$content .= 'Город: ';
					$content .= '<span>';
						$content .= '<a href="'. get_the_permalink() . '">';
						$content .= $post->post_title . '</a>'; 
					$content .= '</span>';																
				wp_reset_postdata();
				$content .= '</li>';

			$content .= '</ul>';
		$content .= '</div>';
		 
	 }
	 $content .= '</div>';
	 }
 
 return $content;
}




/**
 * New post in frontend
  */
function my_pre_save_post( $post_id ) {

	if( $post_id != 'new' ) {
		return $post_id;
	}

	$post = array(
		'post_type'     => 'realty',
		'post_status'   => 'publish', 
		'post_title'    => wp_strip_all_tags($_POST['acf']['field_5de825daf2f50']),
// 		'post_content'  => $_POST['acf']['field_5509d61f8541f'], 
	);

    $post_id = wp_insert_post( $post ); 
	
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );
		
	return $post_id;

}
add_filter('acf/pre_save_post' , 'my_pre_save_post', 10, 1 );

/**
 * Save ACF field as thumbnail
  */
add_action( 'acf/save_post', 'tsm_save_image_field_to_featured_image', 10 );
function tsm_save_image_field_to_featured_image( $post_id ) {

	if( empty($_POST['acf']) ) {
		return;
	}

	$image = $_POST['acf']['field_5de825e5f2f51'];

	if ( empty($image) ) {
		return;
	}

	add_post_meta( $post_id, '_thumbnail_id', $image );

} 

/**
 * Custom styles 
  */
add_action('admin_head', 'custom_style');
function custom_style() {
print '<style>
.acf-field.acf-field-text.acf-field-5de825daf2f50,
.acf-field.acf-field-image.acf-field-5de825e5f2f51,
.acf-field.acf-field-taxonomy.acf-field-5de83566b4745{
	display: none;
}
</style>';
}


