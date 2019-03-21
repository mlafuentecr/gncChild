<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		$info 				= get_field('info');
		$tel1 				= $info['telefono1'];
		$tel2 				= $info['telefono2'];
		$email 				= $info['correElectronico'];
		$horario      = $info['horario'];

		$ubicacion 		= get_field('ubicacion');
		$location 		= $ubicacion['mapa_de_tienda'];

		$direccion 		= get_field('direccion');
		?>

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="tienda-page">
				<div class="grid tienda-grid">
					<div class="grid__item two-thirds">
						<h1 class="tienda_title">Tienda GNC <?php the_title(); ?></h1>
						<div class="tienda_text"><?php echo get_field('direccion'); ?></div>
						<?php if($email){ ?><p class="tienda_email"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p><?php } ?>
						<hr/>
						<?php if($tel1){ ?><span class="tienda_phone-number"><i class="fa fa-phone"></i> <a href="tel:<?php echo $tel1; ?>"><?php echo $tel1; ?></a></span><?php } ?>
						<?php if($tel2){ ?> - <span class="tienda_phone-number"><i class="fa fa-phone"></i> <a href="tel:<?php echo $tel2; ?>"><?php echo $tel2; ?></a></span><?php } ?></br>
						<?php if($horario){ ?><span class="tienda_phone-number"><a href="tel:<?php echo $horario; ?>"><?php echo $horario; ?></a></span><?php } ?></p>

						<?php


						if( !empty($location) ):
						?>
						<div class="acf-map big-map">
							<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
						</div>

						<!-- <form action="http://maps.google.com/maps" method="get" target="_blank">
						   <label for="saddr">Enter your location</label>
						   <input type="text" name="saddr" />
						   <input type="hidden" name="daddr" value="<?php// echo $location['address']; ?>" />
						   <input type="submit" value="Get directions" />
						</form>  -->

						<?php endif; ?>


					</div>
					<div class="grid__item one-thirds">
						<h3>Otras Tiendas</h3>
						<?php
						$args = array(
						'post_type'     => 'nuestras_tiendas',
						'post__not_in' => [get_queried_object_id()],
						 'posts_per_page' => 3
						);

						$the_query = new WP_Query( $args );
						// The Loop
						if ( $the_query->have_posts() ) {
							echo '<div class="Otras_Tiendas">';
							while ( $the_query->have_posts() ) {
								$the_query->the_post(); ?>



									<h2 class="tienda_title"><a href="<?php echo get_permalink(); ?>">Tienda GNC <?php the_title(); ?></a></h2>
									<div class="otras_text"><?php echo get_field('direccion'); ?></div>
									<p class="otras_phone_nummbers"><?php if(get_field('telefono1')){ ?><span class="tienda_phone-number-square"><i class="fa fa-phone"></i> <a href="tel:<?php echo get_field('telefono1'); ?>"><?php echo get_field('telefono1'); ?></a></span><?php } ?>
									<?php if(get_field('telefono2')){ ?> - <span class="tienda_phone-number"><i class="fa fa-phone-square"></i> <a href="tel:<?php echo get_field('telefono2'); ?>"><?php echo get_field('telefono2'); ?></a></span><?php } ?></p>
									<?php if(get_field('correElectronico')){ ?><p class="otras_email"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo get_field('correElectronico'); ?>"><?php echo get_field('correElectronico'); ?></a></p><?php } ?>
									<p class="mas_info"><a href="<?php echo get_permalink(); ?>" class="btn button">MAS INFO</a></p>

									<hr/>



							<?php
							}
							echo '</ul>';
							/* Restore original Post Data */
							wp_reset_postdata();
						} else {
							// no posts found
						}
						?>
					</div>
				</div>
			</div>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<style type="text/css">

.acf-map {
	width: 100%;
	height: 150px;
	border: #ccc solid 1px;
	margin: 20px 0;
}

/* fixes potential theme css conflict */
.acf-map img {
   max-width: inherit !important;
}

.big-map{
	height: 400px;
}


</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8vm_1mZaCYAgfYrlcYIlPvZoZ2wRnHJo"></script>
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

})(jQuery);
</script>
<?php
do_action( 'storefront_sidebar' );
get_footer();
