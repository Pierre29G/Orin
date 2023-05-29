<?php
add_filter( 'rwmb_meta_boxes', 'metas_contact' );

function metas_contact( $meta_boxes ) {

    $fields = [
            [
                'name'            => 'Type de point',
                'id'              => 'point_type',
                'type'            => 'select',
                'multiple'        => false,
                'options'         => [
                    'legend'      => 'Légende',
                    'history'     => 'Historique',
                ],
            ],
            [
                'name'              => 'Sous-titre',
                'id'                => 'point_undertitle',
                'type'              => 'text',
            ],
            [
                'name'              => 'Contenu texte',
                'id'                => 'point_text',
                'type'              => 'wysiwyg',
                'raw'     => false,
                'options' => [
                    'textarea_rows' => 4,
                ],
            ],
            [
                'name'              => 'Contenu texte carte',
                'id'                => 'point_text_map',
                'type'              => 'wysiwyg',
                'raw'     => false,
                'options' => [
                    'textarea_rows' => 4,
                ],
            ],
            [
                'name'         => 'Image(s) pour le point',
                'id'           => 'point_img',
                'type'         => 'image',
                'force_delete' => false,
            ],
            [
                'name'          => 'Position du point',
                'id'            => 'point_position',
                'type'          => 'osm',
                'std'           => '47.218371,-1.553621',
            ],
    ];

    $meta_boxes[] = [
        'post_types'    => array('point'),
        'title' => __('Options du point'),
        'id' => 'point-metas',
        'fields'     => $fields,
    ];

    return $meta_boxes;
}