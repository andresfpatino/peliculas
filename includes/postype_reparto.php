<?php

if ( ! defined( 'ABSPATH' ) ) {	exit; }

function reparto_post_type() {
	$labels = array(
        'name'                  => _x( 'Actor', 'Post type general name', 'maquinando' ),
        'singular_name'         => _x( 'Actor', 'Post type singular name', 'maquinando' ),
        'menu_name'             => _x( 'Actores', 'Admin Menu text', 'maquinando' ),
        'add_new'               => __( 'Agregar Actor', 'maquinando' ),
        'add_new_item'          => __( 'Agregar nuevo Actor', 'maquinando' ),
        'new_item'              => __( 'Nuevo Actor', 'maquinando' ),
        'edit_item'             => __( 'Editar Actor', 'maquinando' ),
        'view_item'             => __( 'Ver Actor', 'maquinando' ),
        'all_items'             => __( 'Todos los Actores', 'maquinando' ),
        'search_items'          => __( 'Buscar Actor', 'maquinando' ),
        'parent_item_colon'     => __( 'Padre Actor:', 'maquinando' ),
        'not_found'             => __( 'No encontrado', 'maquinando' ),
        'not_found_in_trash'    => __( 'No encontrado', 'maquinando' ),
        'featured_image'        => _x( 'Imagen destacada', '', 'maquinando' ),
    );    
	$args = array(
        'labels'             => $labels,
		'public'             => true,
		'show_ui'            => true,
        'has_archive'        => true,
		'rewrite'            => array( 'slug' => 'actores'),
		'capability_type'    => 'post',
		'menu_icon'          => 'dashicons-businessperson',
		'menu_position'      => 5,
		'supports'           => array('title','editor','thumbnail')
	);
	register_post_type( 'actores', $args );	
}
add_action( 'init', 'reparto_post_type');

/* Flush Rewrite - regenera .htacess*/
function reparto_rewrite_flush(){
    reparto_post_type();
    flush_rewrite_rules();
  }  