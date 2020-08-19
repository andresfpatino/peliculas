<?php

if ( ! defined( 'ABSPATH' ) ) {	exit; }

function peliculas_post_type() {
	$labels = array(
        'name'                  => _x( 'Peliculas', 'Post type general name', 'maquinando' ),
        'singular_name'         => _x( 'Pelicula', 'Post type singular name', 'maquinando' ),
        'menu_name'             => _x( 'Peliculas', 'Admin Menu text', 'maquinando' ),
        'add_new'               => __( 'Agregar pelicula', 'maquinando' ),
        'add_new_item'          => __( 'Agregar nueva pelicula', 'maquinando' ),
        'new_item'              => __( 'Nueva Pelicula', 'maquinando' ),
        'edit_item'             => __( 'Editar Pelicula', 'maquinando' ),
        'view_item'             => __( 'Ver Pelicula', 'maquinando' ),
        'all_items'             => __( 'Todas las Peliculas', 'maquinando' ),
        'search_items'          => __( 'Buscar Peliculas', 'maquinando' ),
        'parent_item_colon'     => __( 'Padre Peliculas:', 'maquinando' ),
        'not_found'             => __( 'No encontrado', 'maquinando' ),
        'not_found_in_trash'    => __( 'No encontrado', 'maquinando' ),
        'featured_image'        => _x( 'Portada', '', 'maquinando' ),
    );    
	$args = array(
        'labels'             => $labels,
		'public'             => true,
        'show_ui'            => true,	
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'peliculas'),
		'capability_type'    => 'post',
		'menu_icon'          => 'dashicons-video-alt2',
		'menu_position'      => 5,
		'supports'           => array('title','editor','thumbnail')
	);
	register_post_type( 'peliculas', $args );	
}
add_action( 'init', 'peliculas_post_type' );


/* Flush Rewrite - regenera .htacess*/
function peliculas_rewrite_flush(){
    peliculas_post_type();
    flush_rewrite_rules();
}  