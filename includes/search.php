<section class="peliculas__media-header">       
    <h1 class="peliculas__media-header--title">Bienvenidos.</h1>
    <p class="peliculas__media-header--subtitle">Millones de películas, programas de televisión y actores por descubrir. Explora ahora!</p>
    <div id="movie-finder">
     
        <input id="search-movie" type="text" placeholder="Buscar una película, programa de televisión, actor"> 
		       
        <div class="search-results"></div>

		<?php
			function find_movie() {
				$movies_found = [];

				if ( isset( $_POST['query'] ) && ! empty( $_POST['query'] ) ) {
					$args = [
						'post_type'   => array( 'peliculas', 'actores' ),
						'post_status' => 'publish',
						's'           => $_POST['query'],
					];

					$movies = get_posts( $args );

					foreach ( $movies as $movie ) {
						$movies_found[] = [
							'title'   => $movie->post_title,
							'content' => $movie->post_content,
							'image'   => get_the_post_thumbnail_url( $movie->ID ),
							'link'    => get_permalink( $movie->ID ),
						];
					}
				}
				wp_send_json( $movies_found );				
			}

		?>

    </div>
</section>