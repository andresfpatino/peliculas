<?php

if ( ! defined( 'ABSPATH' ) ) {	exit; }

get_header(); ?>


<main class="peliculas container">

    <?php include(WP_CONTENT_DIR. '/plugins/peliculas/includes/search.php'); ?>

    <div class="single-peliculas row justify-content-center">
    
        <div class="col-md-4"> 
            <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail('full', ['class' => 'card-img-top']);
            } else { ?>
                <img class="card-img-top" src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/img/default-movie.png"/>
                <?php }
            ?>     
        </div>
    
        <div class="col-md-8">  
            <h1 class="title"><?php the_title(); ?></h1>
            <div class="d-flex flex-row meta">
                <!--Si es película -->
                <?php if ( is_singular('peliculas') ) { ?>
                    <p class="publish-date"> <b>Fecha estreno:</b> <?php echo get_the_date('d F Y'); ?></p>    
                    <?php $puntuacion = get_post_meta($post->ID, 'puntacion_pelicula', true);
                    if ( !empty($puntuacion)) : ?>                                        
                        <p class="score"> <b>Puntuación:</b> <?php echo $puntuacion; ?> ★ </p>  
                    <?php endif ?>   
                 <!--Si es actor -->
                <?php } else { ?>
                    <p class="publish-date"> <b>Fecha Nacimiento:</b> <?php echo get_the_date('d F Y'); ?></p>       
                <?php } ?>  
            </div>
            
            <!--Si es película -->
            <?php if ( is_singular('peliculas') ) { ?>
                <h4 class="subtitle">Sinopsis</h4>
             <!--Si es actor -->
            <?php } else { ?>
                <h4 class="subtitle">Biografia</h4>
            <?php } ?>            
            <div class="sinopsis">
                <?php the_content(); ?>
            </div>
    
            <!--Si es película -->
            <?php if ( is_singular('peliculas') ) { ?>
                <h4 class="subtitle">Reparto:</h4>
                <?php $reparto = get_post_meta($post->ID, "checkfield", true);  
                if( empty(  $reparto) ) :
                    echo 'No hay actores asociados';
                else:
                    echo '<ul class="list-reparto">';
                    foreach($reparto as $actor){
                        echo '<li>'.$actor. ', ' .'</li>';
                    }
                    echo '</ul>';
                endif;
            // Si es actor
            } else { ?>
                <h4 class="subtitle">Conocido por las películas:</h4>
                <?php $peliculas = get_post_meta($post->ID, "checkfield", true); 
                if( empty( $peliculas) ) :
                    echo 'No hay películas asociadas';
                else:
                    echo '<ul class="list-reparto">';
                    foreach($peliculas as $pelicula){
                        echo '<li>'.$pelicula. ', ' .'</li>';
                    }
                    echo '</ul>';
                endif;
            } ?>           
        </div>    
    </div>
</main>

<?php get_footer(); ?>