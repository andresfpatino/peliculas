<?php

if ( ! defined( 'ABSPATH' ) ) {	exit; }

get_header(); ?>


<main class="peliculas container">

    <?php include(WP_CONTENT_DIR. '/plugins/peliculas/includes/search.php'); ?>

    <section class="content-peliculas">
        <div class="row row-cols-1 row-cols-md-4 justify-content-center">     
            <?php
                $args = array(
                    'type' => 'post',
                    'post_type' => 'actores', 
                    'post_status'=>'publish',
                    'orderby'  => 'rand',
                    'posts_per_page' => -1,
                );
                $peliculas = new WP_Query( $args );
            ?>
            <?php if( $peliculas->have_posts() ): ?>
                <?php while( $peliculas->have_posts() ): $peliculas->the_post(); ?>
                    <div class="col-md-3 col-sm-6 mb-4 box-pelicula pelicula">             
                        <div class="card">    
                            <a href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) {
                                        the_post_thumbnail('full', ['class' => 'card-img-top']);
                                    } else { ?>
                                    <img class="card-img-top" src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/img/default-movie.png"/>
                                    <?php }
                                ?>  
                                <div class="overlay"></div>       
                                <div class="card-body">                                                                       
                                    <h5 class="card-title" title="<?php the_title(); ?>"><?php the_title(); ?></h5>
                                    <p class="publish-date" title="Fecha nacimiento"><?php echo get_the_date('d F Y'); ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
                <div class="row justify-content-center"> 
                    <div id="loadMore" class="btn-group btn-group-lg">
                        <a href="#" class="btn">Ver más</a>
                    </div>           
                </div>
                <?php else: ?>
                <p class="text-center"> ¡No hay peliculas publicadas! </p>
            <?php endif; ?>        
            </div>
    </section>

</main>

<?php get_footer(); ?>