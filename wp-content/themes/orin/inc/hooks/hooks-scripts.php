<?php

function scripts() {

	global $is_IE;

	/**
	*	Styles
	*/

	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Playfair+Display:ital,wght@1,600&display=swap', false );
	wp_enqueue_style( 'mapbox', 'https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css', false );
	
	wp_enqueue_style( 'orin-main', get_template_directory_uri().'/assets/css/main.css');
	wp_enqueue_style( 'orin-header', get_template_directory_uri().'/assets/css/header.css');
	wp_enqueue_style( 'orin-front-page', get_template_directory_uri().'/assets/css/front-page.css');
	wp_enqueue_style( 'orin-single', get_template_directory_uri().'/assets/css/single.css');
	wp_enqueue_style( 'orin-carousel', get_template_directory_uri().'/assets/css/carousel.css');
	wp_enqueue_style( 'style', get_stylesheet_uri());


	/**
	*	Scripts
	*/

	wp_enqueue_script( 'embla', 'https://unpkg.com/embla-carousel/embla-carousel.umd.js', null, null, false );
	wp_enqueue_script( 'mapbox', 'https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js', null, null, false );

	wp_enqueue_script( 'wp-api' );
	
	wp_enqueue_script( 'orin-carousel', get_template_directory_uri() . '/assets/js/carousel.js', array(), '', false);
	wp_enqueue_script( 'orin-main', get_template_directory_uri() . '/assets/js/main.js', array(), '', false);
	wp_localize_script( 'orin-main', 'theme_options', [ 'ajaxurl' => admin_url( 'admin-ajax.php' ), 
													  'pathurl' => get_template_directory_uri() 
													] );

	

	/**
	*	Scripts pour la carte
	*/

	wp_enqueue_script( 'orin-map', get_template_directory_uri() . '/assets/js/map.js', array(), '', false);

	//création de l'array des points pour le JS de la carte (assets/js/map.js)
	$points = [];
	$query = new WP_Query( [
		'post_type' => 'point',
	] );
	foreach ( $query->posts as $post ) {

		$pos= rwmb_get_value('point_position', '', $post->ID);

		$point					= [];
		$point['id']   			= $post->ID;
		$point['title']   		= $post->post_title;
		$point['undertitle']   	= rwmb_get_value( 'point_undertitle', '', $post->ID );
		$point['content']   	= rwmb_get_value( 'point_text_map', '', $post->ID );
		$point['img']    		= array_shift(array_values(rwmb_meta('point_img', ['size' => 'large'], $post->ID)))['url'];
		$point['latitude']  	= $pos['latitude'];
		$point['longitude'] 	= $pos['longitude'];
		$point['url'] 			= get_permalink($post->ID);
		$point['type']    		= rwmb_get_value( 'point_type', '', $post->ID );
		$points[]         		= $point;
	}
	wp_localize_script( 'orin-map', 'Points', $points );
	wp_localize_script( 'orin-map', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action( 'wp_enqueue_scripts', 'scripts', 1 );