<?php
$classes = array(
    'grid__item',
    'one-third'
	);
?>
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

<div <?php echo post_class( $classes ); ?> >
	<div class="map-box">
		<?php


		if( !empty($location) ):
		?>
		<div class="acf-map">
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
		</div>
		<?php endif; ?>
		<div class="card-body">
			<p class="mas_info"><a href="<?php echo get_permalink(); ?>" class="btn button">MAS INFO</a></p>
			<h4><a href="<?php echo get_permalink(); ?>">Tienda GNC <?php echo get_the_title(); ?></a></h4>
			<div class="location_text"><i class="fa fa-map-marker"></i> <?php echo get_field('direccion'); ?></div>
			<?php if($tel1){ ?><p class="phone-number"><i class="fa fa-phone"></i> <a href="tel:<?php echo $tel1; ?>"><?php echo $tel1; ?></a></p><?php } ?>
			<?php if($tel2){ ?><p class="phone-number"><i class="fa fa-phone"></i> <a href="tel:<?php echo $tel2; ?>"><?php echo $tel2; ?></a></p><?php } ?>
		</div>
	</div>
</div>
