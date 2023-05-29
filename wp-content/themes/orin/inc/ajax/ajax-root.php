<?php

add_action( 'wp_ajax_get_roots', 'get_roots', 10, 1 );
add_action( 'wp_ajax_nopriv_get_roots', 'get_roots', 10, 1 );

function get_roots(){

     $pointid = $_POST['pointid'];
     $points = [];

     $pos= rwmb_get_value('point_position', '', $pointid);

     $point				= [];
     $point['id']   	     = $pointid;
     $point['title']   		= get_the_title($pointid);
     $point['undertitle']   	= rwmb_get_value( 'point_undertitle', '', $pointid );
     $point['content']   	= rwmb_get_value( 'point_text_map', '', $pointid );
     $point['img']    		= array_shift(array_values(rwmb_meta('point_img', ['size' => 'large'], $pointid)))['url'];
     $point['latitude']  	= $pos['latitude'];
     $point['longitude'] 	= $pos['longitude'];
     $point['url'] 			= get_permalink($pointid);
     $point['type']    		= rwmb_get_value( 'point_type', '', $pointid );
     $points[]         		= $point;
     
     //Cette array d'argument récupère les liens reliés au point de la requête
     $args = array(
          'post_type'   => 'lien',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'orderby'   => array(
          'meta_value' =>'ASC',
          ),
          'suppress_filters'=> 0,
          'meta_query' => array(
          //link_point_one ou link_point_two est égale à l'id du point
          'relation' => 'OR',
          array(
               'key'     => 'link_point_one',
               'value'   =>  $pointid,
               'compare' => '==',
          ),
          array(
               'key'     => 'link_point_two',
               'value'   =>  $pointid,
               'compare' => '==',
          ),
          ),
     );

     $query = get_posts( $args );

     foreach ( $query as $link ) {
          if(rwmb_meta('link_point_one', '',$link->ID) == $pointid){
               $linkid = rwmb_meta('link_point_two', '',$link->ID);
           }else{
               $linkid = rwmb_meta('link_point_one', '',$link->ID);
           }

		$pos= rwmb_get_value('point_position', '', $linkid);

		$point				= [];
		$point['id']   	     = $linkid;
		$point['title']   		= get_the_title($linkid);
		$point['undertitle']   	= rwmb_get_value( 'point_undertitle', '', $linkid );
		$point['content']   	= rwmb_get_value( 'point_text_map', '', $linkid );
		$point['img']    		= array_shift(array_values(rwmb_meta('point_img', ['size' => 'large'], $linkid)))['url'];
		$point['latitude']  	= $pos['latitude'];
		$point['longitude'] 	= $pos['longitude'];
		$point['url'] 			= get_permalink($linkid);
		$point['type']    		= rwmb_get_value( 'point_type', '', $linkid );
		$points[]         		= $point;
	}

     wp_send_json( $points );

}