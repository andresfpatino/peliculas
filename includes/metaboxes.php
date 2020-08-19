<?php

if ( ! defined( 'ABSPATH' ) ) {	exit; }

/* ----------- PUNTUACIÓN PELICULAS ----------- */
function metabox_puntuaciones($post){
    add_meta_box('puntuacion', 'Puntuación película', 'puntacion_pelicula', 'peliculas', 'normal' , 'high');
}
add_action( 'add_meta_boxes', 'metabox_puntuaciones' );

// Callback
function puntacion_pelicula($post){
    $puntuacion = get_post_meta($post->ID, 'puntacion_pelicula', true); ?>   
    <label for="selec_puntuacion">Indique la puntuación de la película:  </label>
    <select name="selec_puntuacion" id="selec_puntuacion">
        <option disabled> Indique una puntuación </option>
        <option value="1.0" <?php selected( $puntuacion, '1.0' ); ?>> 1.0 </option>
        <option value="2.0" <?php selected( $puntuacion, '2.0' ); ?>> 2.0 </option>
        <option value="3.0" <?php selected( $puntuacion, '3.0' ); ?>> 3.0 </option>
        <option value="4.0" <?php selected( $puntuacion, '4.0' ); ?>> 4.0 </option>
        <option value="5.0" <?php selected( $puntuacion, '5.0' ); ?>> 5.0 </option>
    </select>
    <?php
}

 // Guarda - actualiza 
 function guardar_puntuacion(){ 
    global $post;
    if(isset($_POST["selec_puntuacion"])){        
        $puntuacion = $_POST['selec_puntuacion'];
        update_post_meta($post->ID, 'puntacion_pelicula', $puntuacion);
    }
}
add_action('save_post', 'guardar_puntuacion');



/* ----------- RELACIONAR ACTORES A LA PELÍCULA ----------- */
function metabox_actores(){
  add_meta_box("actores", "Reparto de la película", "reparto_actores", "peliculas", "normal", "high");
}
add_action("admin_init", "metabox_actores");

// Callback
function reparto_actores( $post ) {
    $checkfield = maybe_unserialize( get_post_meta($post->ID, "checkfield", true) );
    $args = array( 
        'type' => 'post',
        'post_type' => 'actores', 
        'post_status'=>'publish',
        'orderby'  => 'desc',
        'posts_per_page' => -1,
    );

    $actores = get_posts($args);

    if($actores):
        foreach ($actores as $actor): ?>
            <input id="actor_<?php echo $actor->post_title; ?>" type="checkbox" name="checkfield[]" value="<?php echo $actor->post_title; ?>" <?php if ( in_array($actor->post_title, (array) $checkfield) ) { ?> checked <?php } ?>/> <label for="actor_<?php echo $actor->post_title; ?>"><?php echo $actor->post_title; ?></label> <br>
        <?php endforeach; wp_reset_postdata(); ?>
    <?php endif; 
}
    
 // Guarda - actualiza 
function guardar_actores($post_id, $post){   
    if ( isset($_POST['checkfield']) ) { 
        update_post_meta($post_id, "checkfield", $_POST['checkfield'] );
    }
}
add_action( 'save_post', 'guardar_actores', 10, 2 );






/* ----------- RELACIONAR PELÍCULA A LOS ACTORES ----------- */
function metabox_participacion(){
    add_meta_box("participacion_peliculas", "Conocido por las películas", "participacion_peliculas", "actores", "normal", "high");
  }
  add_action("admin_init", "metabox_participacion");
  
  // Callback
  function participacion_peliculas( $post ) {
      $checkfield = maybe_unserialize( get_post_meta($post->ID, "checkfield", true) );
      $args = array( 
          'type' => 'post',
          'post_type' => 'peliculas', 
          'post_status'=>'publish',
          'orderby'  => 'desc',
          'posts_per_page' => -1,
      );
  
      $peliculas = get_posts($args);
  
      if($peliculas):
          foreach ($peliculas as $pelicula): ?>
              <input id="pelicula_<?php echo $pelicula->post_title; ?>" type="checkbox" name="checkfield[]" value="<?php echo $pelicula->post_title; ?>" <?php if ( in_array($pelicula->post_title, (array) $checkfield) ) { ?> checked <?php } ?>/> <label for="pelicula_<?php echo $pelicula->post_title; ?>"><?php echo $pelicula->post_title; ?></label> <br>
          <?php endforeach; wp_reset_postdata(); ?>
      <?php endif; 
  }
      
   // Guarda - actualiza 
  function guardar_peliculas($post_id, $post){   
      if ( isset($_POST['checkfield']) ) { 
          update_post_meta($post_id, "checkfield", $_POST['checkfield'] );
      }
  }
  add_action( 'save_post', 'guardar_peliculas', 10, 2 );