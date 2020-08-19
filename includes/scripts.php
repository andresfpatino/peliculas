<?php

/* Agrega styles al frontend */
function plugin_scripts(){
	wp_enqueue_style('Poppins', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap', array(), "1.0", 'all' );
  	wp_enqueue_style('bootstrap', plugins_url('../assets/libs/bootstrap-4.4.1/css/bootstrap.min.css', __FILE__));
  	wp_enqueue_style('peliculas_style', plugins_url('../assets/css/main.css', __FILE__));
  	wp_enqueue_script('bootstrap', plugins_url('../assets/libs/bootstrap-4.4.1/js/bootstrap.min.js', __FILE__), array('jquery'), 1.0, true); 
  	wp_enqueue_script('peliculas_scripts', plugins_url('../assets/js/main.js', __FILE__), array('jquery'), 1.0, true);
  
  	wp_enqueue_script('peliculas_ajax', plugins_url('../assets/js/ajax.js', __FILE__), array('jquery'), 1.0, true);
  	wp_localize_script( 'peliculas_ajax', 'movies', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
}

add_action('wp_enqueue_scripts', 'plugin_scripts', 9999);
add_action('wp_ajax_nopriv_find_movie', 'find_movie', 9999 );
add_action('wp_ajax_find_movie', 'find_movie', 9999);
