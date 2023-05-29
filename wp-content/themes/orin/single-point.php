<?php 
    get_header();

    $postid = get_the_ID();

    //Cette array d'argument récupère les liens reliés au point de la single
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
                'value'   =>  $postid,
                'compare' => '==',
            ),
            array(
                'key'     => 'link_point_two',
                'value'   =>  $postid,
                'compare' => '==',
            ),
        ),
    );

$links = get_posts( $args );

?>

<section class="point-single point-<?= rwmb_meta('point_type', '', $linkid) ?>">

    <div class="point-image">
    <?php
        $images = rwmb_meta('point_img', ['size' => 'large']);

        //Vérifie le nombre d'image et utilise un carrousel si il y en à plusieurs
        //Le code JS pour le carousel ce situe dans assets/js/carousel.js
        if(count($images) == 1){
            echo '<img src="'. array_shift(array_values($images))['url'] .'">';
        }else{
    ?>

    <div class="embla">
        <div class="embla__viewport">
            <div class="embla__container">

            <?php
                foreach($images as $image){
                    echo(
                        '
                            <div class="embla__slide">
                                <img
                                class="embla__slide__img"
                                src="'.$image['url'].'"
                                />
                            </div>
                        '
                    );
                }
            ?>

            </div>
        </div>
    </div>
        <div class="embla__dots"></div>

    <?php
        }
    ?>
    
    </div>

    <div class="point-content">
        <div class="point-title">
            <div>
                <?php 
                    the_title('<h1 id="point-title">');
                ?>
                <h3><?= rwmb_meta('point_undertitle'); ?></h3>
            </div>
            <a class="button" href="/">Voir sur la carte</a>
        </div>
        
        <?= rwmb_meta('point_text'); ?>

    <?php
        //boucle pour l'affichage des liens
        foreach ( $links as $link ){ 
            if(rwmb_meta('link_point_one', '',$link->ID) == $postid){
                $linkid = rwmb_meta('link_point_two', '',$link->ID);
            }else{
                $linkid = rwmb_meta('link_point_one', '',$link->ID);
            }

                $linkimages = rwmb_meta('point_img', ['size' => 'large'], $linkid);
            ?>
                <div class="link-title">
                    <img class="link-img <?= rwmb_meta('point_type', '', $linkid); ?>" src="<?= array_shift(array_values($linkimages))['url']; ?>">
                    <h2><?= get_the_title( $linkid ) ?></h2>
                </div>

                <?= rwmb_meta('link_text', '',$link->ID); ?>

                <a class="button" href="<?= get_permalink($linkid) ?>">Découvrir</a>
            <?php
        }
    ?>

    </div>
    
</section>

<?php get_footer(); ?>