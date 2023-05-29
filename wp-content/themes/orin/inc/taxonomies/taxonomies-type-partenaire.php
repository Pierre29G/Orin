<?php
add_action( 'init', 'type_partenaire_register_taxonomy' );
function type_partenaire_register_taxonomy() {
	$labels = [
		'name'                       => esc_html__( 'Types de partenaire', 'your-textdomain' ),
		'singular_name'              => esc_html__( 'Type de partenaire', 'your-textdomain' ),
		'menu_name'                  => esc_html__( 'Types de partenaire', 'your-textdomain' ),
		'search_items'               => esc_html__( 'Chercher dans les types de partenaire', 'your-textdomain' ),
		'popular_items'              => esc_html__( 'Types de partenaire souvent utilisé', 'your-textdomain' ),
		'all_items'                  => esc_html__( 'Tous les types de partenaire', 'your-textdomain' ),
		'parent_item'                => esc_html__( 'Parent Type de partenaire', 'your-textdomain' ),
		'parent_item_colon'          => esc_html__( 'Parent Type de partenaire', 'your-textdomain' ),
		'edit_item'                  => esc_html__( 'Editer le type de partenaire', 'your-textdomain' ),
		'view_item'                  => esc_html__( 'Voir ce type de partenaire', 'your-textdomain' ),
		'update_item'                => esc_html__( 'Mettre à jour ce type de partenaire', 'your-textdomain' ),
		'add_new_item'               => esc_html__( 'Ajouter un nouveau type de partenaire', 'your-textdomain' ),
		'new_item_name'              => esc_html__( 'Nouveau type de partenaire nom', 'your-textdomain' ),
		'separate_items_with_commas' => esc_html__( 'Separate types de partenaire with commas', 'your-textdomain' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove types de partenaire', 'your-textdomain' ),
		'choose_from_most_used'      => esc_html__( 'Choose most used types de partenaire', 'your-textdomain' ),
		'not_found'                  => esc_html__( 'No types de partenaire found', 'your-textdomain' ),
		'no_terms'                   => esc_html__( 'No Types de partenaire', 'your-textdomain' ),
		'filter_by_item'             => esc_html__( 'Filter by type de partenaire', 'your-textdomain' ),
		'items_list_navigation'      => esc_html__( 'Types de partenaire list pagination', 'your-textdomain' ),
		'items_list'                 => esc_html__( 'Types de partenaire list', 'your-textdomain' ),
		'most_used'                  => esc_html__( 'Most Used', 'your-textdomain' ),
		'back_to_items'              => esc_html__( 'Back to types de partenaire', 'your-textdomain' ),
	];
	$args = [
		'label'              => esc_html__( 'Types de partenaire', 'your-textdomain' ),
		'labels'             => $labels,
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		'hierarchical'       => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'show_in_rest'       => true,
		'show_tagcloud'      => true,
		'show_in_quick_edit' => true,
		'show_admin_column'  => false,
		'query_var'          => true,
		'sort'               => false,
		'meta_box_cb'        => 'post_tags_meta_box',
		'rest_base'          => '',
		'rewrite'            => [
			'with_front'   => false,
			'hierarchical' => false,
		],
	];
	register_taxonomy( 'type-partenaire', ['partenaire'], $args );
}