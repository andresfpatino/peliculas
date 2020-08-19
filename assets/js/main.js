
$ = jQuery;

$( document ).ready(function () {
  /* Carga peliculas de 4 en 4 */
  $(".pelicula").slice(0, 4).show();
    if ($(".box-pelicula:hidden").length != 0) {
      $("#loadMore").show();
    }   
    $("#loadMore").on('click', function (e) {
      e.preventDefault();
      $(".pelicula:hidden").slice(0, 4).slideDown();
      if ($(".pelicula:hidden").length == 0) {
        $("#loadMore").fadeOut('slow');
      }
    });
});