<?php
add_filter( 'rwmb_meta_boxes', 'metas_fiche' );

function metas_fiche( $meta_boxes ) {

    $fields = [
        [
            'name'        => 'Point 1',
            'id'          => 'link_point_one',
            'type'        => 'post',
            'post_type'   => 'point',
            'field_type'  => 'select_advanced',
            'placeholder' => 'Sélectionnez un point',
            'query_args'  => [
                'post_status'    => 'publish',
                'posts_per_page' => - 1,
            ],
        ],
        [
            'name'        => 'Point 2',
            'id'          => 'link_point_two',
            'type'        => 'post',
            'post_type'   => 'point',
            'field_type'  => 'select_advanced',
            'placeholder' => 'Sélectionnez un point',
            'query_args'  => [
                'post_status'    => 'publish',
                'posts_per_page' => - 1,
            ],
        ],
        [
            'name'              => 'Contenu texte',
            'id'                => 'link_text',
            'type'              => 'wysiwyg',
            'raw'     => false,
            'options' => [
                'textarea_rows' => 4,
            ],
        ],
        
    ];

    $meta_boxes[] = [
        'post_types'    => array('lien'),
        'title' => __('Options du lien'),
        'id' => 'lien-metas',
        'fields'     => $fields,
    ];



    return $meta_boxes;
}