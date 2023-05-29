<?php

add_action( 'wp_ajax_display_resultat', 'display_resultat', 10, 1 );
add_action( 'wp_ajax_nopriv_display_resultat', 'display_resultat', 10, 1 );

function display_resultat(){

     $resultat = 0;
     $html = "";

     $adresseclient = $_POST['adresseclient'];

     global $wpdb;

     $requete = "SELECT `territoire` FROM `iris_nantes_test` WHERE `full_adresse` = '". $adresseclient ."'";

     $result = $wpdb->get_results( $requete , ARRAY_A );

     if(empty($result)){
          $resultat = 2;

          if($adresseclient == 'none'){
               $resultat = 3;
          }
     }else{
          $resultat = 1;
          $the_slug = $result[0]['territoire'];
     }

     if($resultat == 1){
     
          $args = array(
               'posts_per_page' => 1,
               'name'        => $the_slug,
               'post_type'   => 'lieu',
               'orderby'     => 'date',
               'order'       => 'ASC',
          );

          $the_query = get_posts( $args );     
          if(! empty($the_query) ){
               foreach ($the_query as $post){

               $html .= "<div class='good'><h3>Votre espace d'accueil est :</h3><p>" . apply_filters('the_title', $post->post_title) . "</p>";
               $html .= "<div class='contact-info'><p>". rwmb_meta( "adresse-cont", '' , $post->ID ) ."</p>";
               $html .= "<p>". rwmb_meta( "telephone-cont", '' , $post->ID ) ."</p>";
               $html .= "<p>". rwmb_meta( "acces-cont", '' , $post->ID ) ."</p>";
               $html .= "<a class='button' href='". get_site_url(). "/contact/'>Formulaire de contact</a></div></div>";
               
               }
          }
     }else if($resultat == 2){ 
          $html .= "<div class='bad'><h3>L'adresse que vous avez rentrée n'est pas valide, choisissez votre adresse parmi les options.</h3></div>";
     }else if($resultat == 3){
          $html = "<div class='good'><h3>Appelez-nous au <br>" . rwmb_meta( 'tel-sans-adresse', ['object_type' => 'setting'], 'theme_options' ) . "</h3><p>(Appel gratuit)</p>
          <a class='button' href='/contact/'>Prendre contact</a>
          </div>";
     }

      echo $html;
      die();
}