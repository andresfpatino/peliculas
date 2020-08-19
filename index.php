<?php
/*
Plugin Name: Peliculas
Plugin URI:
Description: Prueba desarrollador Fullstack WordPress, Maquinando Go Digital. - Plugin para añadir peliculas y actores
Version: 1.0
Author: Andrés Felipe Patiño
Author URI: mailto:andresfelipepatino5@gmail.com
License: GPL2
License URI: https://www.gnu.org/licences/gpl-2.0.html
Text Domain: maquinando
*/


/* --- Register Scripts - Styles */
require_once plugin_dir_path( __FILE__ ) . 'includes/scripts.php';

/* --- Añade el postype Peliculas */
require_once plugin_dir_path( __FILE__ ) . 'includes/postype_peliculas.php';

/* --- Añade el postype Reparto */
require_once plugin_dir_path( __FILE__ ) . 'includes/postype_reparto.php';

/* Regenera las reglas de las url al activar -desactivar plugin */
register_activation_hook(__FILE__, 'peliculas_rewrite_flush');
register_deactivation_hook( __FILE__, 'peliculas_rewrite_flush' );
register_activation_hook(__FILE__, 'reparto_rewrite_flush');
register_deactivation_hook( __FILE__, 'reparto_rewrite_flush' );

/* --- Archive peliculas */
function archive_peliculas( $template ) {
	if ( is_post_type_archive('peliculas') ) {
    	$theme_files = array('archive-peliculas.php', 'archive-peliculas.php');
    	$exists_in_theme = locate_template($theme_files, false);
    	if ( $exists_in_theme != '' ) {
      		return $exists_in_theme;
    	} else {
      		return plugin_dir_path(__FILE__) . 'archive-peliculas.php';      
    	}	
  	}
  	return $template;
}
add_filter('template_include', 'archive_peliculas');


/* --- Archive actores*/
function archive_actores( $template ) {
	if ( is_post_type_archive('actores') ) {
		$theme_files = array('archive-actores.php', 'archive-actores.php');
	  	$exists_in_theme = locate_template($theme_files, false);
	  	if ( $exists_in_theme != '' ) {
			return $exists_in_theme;
	  	} else {
			return plugin_dir_path(__FILE__) . 'archive-actores.php';      
	 	}
	}
	return $template;
}
add_filter('template_include', 'archive_actores');


/* -- Single peliculas - actores */
function override_single_template( $single_template ){
    global $post;
    $file = plugin_dir_path(__FILE__).'single.php';
    if( file_exists( $file ) ) $single_template = $file;
    return $single_template;
}
add_filter( 'single_template', 'override_single_template' );


/* --- Metaboxes */
require_once plugin_dir_path( __FILE__ ) . 'includes/metaboxes.php';

