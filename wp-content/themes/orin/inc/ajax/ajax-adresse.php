<?php

add_action( 'wp_ajax_get_adresse', 'get_adresse', 10, 1 );
add_action( 'wp_ajax_nopriv_get_adresse', 'get_adresse', 10, 1 );

function get_adresse(){

     global $wpdb;

     $requete = "SELECT `full_adresse` AS `adresse` FROM iris_nantes_test";

     $result = $wpdb->get_results( $requete , ARRAY_A );
     
     wp_send_json( $result );

}