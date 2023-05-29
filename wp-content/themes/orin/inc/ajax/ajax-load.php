<?php

add_action( 'wp_ajax_load_more', 'load_more', 10, 1 );
add_action( 'wp_ajax_nopriv_load_more', 'load_more', 10, 1 );

function load_more(){
     
     $postid = $_POST['idpost'];
     $html = "";

$args = array(
    'posts_per_page' => 10,
    'post_type'   => 'post',
    'orderby'     => 'date',
    'order'       => 'DESC',
);

$the_query = get_posts( $args );

if(! empty($the_query) ){
foreach ($the_query as $post){
    if($postid != ($post->ID) ){

    $categ = get_the_category($post->ID);
    $date = get_the_date('d F Y', $post->ID);
?>

<section class="single-single">
        <section class="hero-loop">
            <div class="padded">
                <?php 
                echo '<div><p>— '.$categ[0]->name.'</p>';
                echo '<p>'.$date.'</p></div>';
                echo '<h2>'.get_the_title($post->ID).'</h2>';
                ?>

                <?= '</div>' ?>
        </section>

        <section class="padded single-content-loop">
            <div class="thumbnail">
                <?= get_the_post_thumbnail($post->ID, 'full' ); ?>
            </div>

        <article class="content-text gutenberg">

            <p class="excerpt-article"><?= get_the_excerpt($post->ID); ?></p>

            <?= apply_filters('the_content', $post->post_content); ?>

        </article>

        <div class="back-button"><a class="button" href="<?=get_site_url() ?>/le-media/">retour aux articles</a></div>
        </section>

</section>

<div class="separator"></div>

<?php 

echo $html;

$html = '';
}}}

      die();
}