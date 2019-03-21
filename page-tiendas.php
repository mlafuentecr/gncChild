<?php
/**
 * Template Name: Tiendas Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header();

$count_posts = wp_count_posts( 'nuestras_tiendas' )->publish;

?>

<div class="header-text">
	<div class="container">
		<h3><strong><?php echo $count_posts; ?></strong><span>MÁS DE <?php echo $count_posts; ?> LOCACIONES VENÍ Y VISITANOS EN CUALQUIERA DE NUESTRAS TIENDAS</span></h3>
	</div>
</div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			<div id="post-<?php the_ID(); ?>" class="post-107 page type-page status-publish hentry">
				<header class="entry-header">
					<h1 class="entry-title">Tiendas</h1>

					<?php
						$taxonomy = 'posicion';
						$tax_terms = get_terms($taxonomy, array('hide_empty' => false));
						echo '<select id="changeUrl">';
						foreach($tax_terms as $term_single) {
							echo '<option value=".posicion-'.$term_single->slug.'">'. $term_single->name .'</option>';
						}
						echo '</select>';
					?>

				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</div>

			<div class="map-grid">

			<?php
			$args = array( 'post_type' => 'nuestras_tiendas', 'posts_per_page' => 30 , 'orderby' => 'title', 'order' => 'ASC' );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();

			  get_template_part( 'content-nuestras_tiendas' );

			endwhile;
			?>

			</div>


		</main><!-- #main -->
	</div><!-- #primary -->
<style type="text/css">

.acf-map {
	width: 100%;
	height: 200px;
	border: #ccc solid 1px;
	margin: 20px 0;
}

/* fixes potential theme css conflict */
.acf-map img {
   max-width: inherit !important;
}

</style>

<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {

	// var
	var $markers = $el.find('.marker');


	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};


	// create map
	var map = new google.maps.Map( $el[0], args);


	// add a markers reference
	map.markers = [];


	// add markers
	$markers.each(function(){

    	add_marker( $(this), map );

	});


	// center map
	center_map( map );


	// return
	return map;

}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

	$('.map-grid .card-body').matchHeight();

});




$(document).ready(function(){
	// init Isotope
var $grid = $('.map-grid').isotope({
  itemSelector: '.grid__item',
  layoutMode: 'fitRows'
});

// bind filter on select change
$('#changeUrl').on( 'change', function() {
  // get filter value from option value
  var filterValue = this.value;
  $grid.isotope({ filter: filterValue });
});


})




})(jQuery);
</script>
<?php
do_action( 'storefront_sidebar' );
get_footer();
