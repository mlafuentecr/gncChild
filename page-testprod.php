<?php
/**
 * Template Name: Test Prod Page1
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>


	<div class="header_page-title">
		<div class="container">
			<h1><?php the_title(); ?></h1>
		</div>
	</div>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();
				do_action( 'storefront_page_before' ); 
				?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

				<?php
				do_action( 'storefront_page_after' );
				endwhile; // End of the loop. 
				?>





			<?php

			// $dolar_price_field[$i] 		 = isset( $_POST['_dolar_price_field'] ) ? $_POST['_dolar_price_field'] : '';
			// // $dolarSale_price_field[$i] = isset( $_POST['_dolar_price_field_sale'] ) ? $_POST['_dolar_price_field_sale'] : '';
			// // update_post_meta($item->ID, '_dolar_price_field', 			$dolar_price_field[$i]);
			// // update_post_meta($item->ID, '_dolar_price_field_sale', 			$dolarSale_price_field[$i]);


if( current_user_can('administrator') ) {
		global $post;
		$currentcy_settings = get_option( 'gnc_currency_settings' );
		$rate = $currentcy_settings[gnc_currency_text_field_0];
		$i=0;


		$args = array( 
			'post_type'   => 'product',
			'post_status'   => 'any',
			'numberposts' => -1,
			);
			$shop_products = get_posts( $args );

//////////////////////
	///Make ALL POST PUBLISH			

		// foreach ( $shop_products as $post ) {
		// 	echo 'xxxxx'.$post->ID;
		// 	wp_update_post(array('ID' => $post->ID, 'post_status'   =>  'publish'));
		// } 

		

			// Number Field Dolares regular price
		foreach( $shop_products as $item){

			$post_id 									  = $item->ID;
			$product 	 					   			= wc_get_product( $item->ID);
			$productType 								= $product->get_type();
			$regular_price							= get_post_meta( $item->ID, '_regular_price' );
			$dolar_price_field				  = get_post_meta( $item->ID, '_dolar_price_field' );
			$dolarSale_price_field			= get_post_meta( $item->ID, '_dolar_price_field_sale' );
			$pgStatus			 							= get_post_status ( $item->ID );
			
			//print_r ('////////'.$productType.'</br>');
			//var_dump($product);//product-variable



if($productType === 'simple'){
				///////////////////////////////// 
				//////////////////////////////// PRODUCTO Simple

		$regular_price							=	$regular_price[0];
		$dolar_price_field					=	$dolar_price_field[0];
		$dolarSale_price_field			=	$dolarSale_price_field[0];
		
		
	
		if( $dolar_price_field == 'Array' ){		update_post_meta($post_id, '_dolar_price_field', 		'');}
		if( $dolarSale_price_field == 'Array' ){update_post_meta($post_id, '_dolar_price_field_sale', 		'');}

		
		if($regular_price > 0 && empty( $dolar_price_field ) && empty( $dolarSale_price_field )){
		 // si tiene un precio en colones y no hay dolares pues deje asi mijo
			echo '<a  target="_blank" href="/gnctest/wp-admin/post.php?post='.$item->ID.'&action=edit">  '.$i.') id= '.$item->ID.' 	&nbsp; 	&nbsp; | &nbsp; SIMPLE 	&nbsp; | Est= '.$pgStatus.'&nbsp; | &nbsp; Precio= '.$regular_price.'  </a></br>';

		}elseif($regular_price <= 0 || $regular_price == '' ||  $regular_price == 'Array' ){
			
			//Check if price is 0
			$postToPrivate = array( 'ID' => $post_id, 'post_status' => 'private', );
			wp_update_post( $postToPrivate );

			$regular_price = '';
			//precio normal  es ta vacio revisar
			echo '<a  target="_blank" href="/gnctest/wp-admin/post.php?post='.$item->ID.'&action=edit">  '.$i.') id='.$item->ID.' 	&nbsp; 	&nbsp; | &nbsp; SIMPLE 	&nbsp; | Est= '.$pgStatus.'&nbsp; | &nbsp; >>>>>>> PROBLEMA PRECIO  REVISAR  <<<<<< </a></br>';

			
		}else{

		// check if the product has Dollar value
		if (!empty( $dolar_price_field ) && $dolar_price_field > 0){
	
					// Multiply Dollar value with conversion rate
					$regular_price = ceil(($dolar_price_field* $rate) ); 

				echo '<a  target="_blank" href="/gnctest/wp-admin/post.php?post='.$item->ID.'&action=edit"> '.$i.')  id='.$item->ID.' |  SIMPLE  | Est='.$pgStatus.' | Dolar= '.$dolar_price_field.'  | Precio= '.$regular_price.' </a></br>';

			}											


			//Promocion Dolares presente
			if ($dolarSale_price_field  > 0 &&  $dolar_price_field > 0 ){
			
				$sales_price	 = round($dolarSale_price_field * $rate);
				$regular_price = $regular_price - $sales_price;
					// Multiply Dollar value with conversion rate
					echo 'Tiene Promo id='.$item->ID;

			}

				}


				// update_post_meta($post_id, '_dolar_price_field', 			$dolar_price_field);
				// update_post_meta($post_id, '_dolar_price_field_sale', $dolarSale_price_field);
		
				update_post_meta($post_id, '_sale_price', 					  $sales_price);
				update_post_meta($post_id, '_regular_price', 					$regular_price);
				update_post_meta($post_id, '_price', 									$regular_price);
				












				
			}else{

				///////////////////////////////// 
				//////////////////////////////// PRODUCTO VARIABLE





				$product_variations 	= new WC_Product_Variable( $post_id );
				$product_variations 	= $product_variations->get_available_variations();

				echo ' </br>'. $i.')  Variable id= '.$post_id. ' Estado='.$pgStatus. '</br>';

				foreach ( $product_variations as $variation ) {
					
				$item_ID								=  $variation['variation_id'];
				$item_price							=  $variation['display_regular_price'];
				$Dolar_number_field 		= get_post_meta( $item_ID, '_dolar_price_field' );
				$dolarSale_price_field 	= get_post_meta( $item_ID, '_dolar_price_field_sale' );
				$Dolar_number_field 		=	$Dolar_number_field[0];
				$dolarSale_price_field 	=	$dolarSale_price_field[0];

				//Limpio si estan sucios
				if( $dolar_price_field == 'Array' ){update_post_meta($item_ID, '_dolar_price_field', 		'');}
				if( $dolarSale_price_field == 'Array' ){update_post_meta($item_ID, '_dolar_price_field_sale', 		'');}

				if( $item_price == 'Array' || $item_price == '' || $item_price <= 0 ){
					
							//Check if price is 0
							$postToPrivate = array( 'ID' => $item->ID, 'post_status' => 'private', );
						 update_post_meta($item_ID, '_regular_price', 		0);
						 
						 wp_update_post( $postToPrivate );

						 echo '<a  target="_blank" href="/gnctest/wp-admin/post.php?post='.$item->ID.'&action=edit"> SKU  '.$item_ID. ' | Est= '.$pgStatus.' >>>>>>> PROBLEMA PRECIO  REVISAR  <<<<<< '.$regular_price.' </a></br> ';

				}
			



				// Dolares presente
				if($Dolar_number_field <= 0 || empty( $Dolar_number_field)){
					
				}elseif( ! empty( $Dolar_number_field  )){
					$regular_price = round($Dolar_number_field * $rate);
				}


				//Promocion Dolares presente
				if (! empty( $dolarSale_price_field ) &&  ! empty( $dolar_price_field )){
				
					$sales_price	 = round($dolarSale_price_field * $rate);
					$regular_price = $regular_price - $sales_price;
						// Multiply Dollar value with conversion rate
						echo '<a  target="_blank" href="/gnctest/wp-admin/post.php?post='.$item->ID.'&action=edit"> Tiene Promo  |  SKU  '.$item_ID.' | tipoCambio= '.$rate.'  | precio en $ '.$Dolar_number_field.'   | precio=  '.$item_price.' 	</a> ';
				}
				



				update_post_meta($item_ID, '_sale_price', 		$sales_price);
				update_post_meta($item_ID, '_regular_price', 	$regular_price);
				update_post_meta($item_ID, '_price', 					$regular_price);
				wc_delete_product_transients( $post_id );
				//Lo pongo aca para que refresque el precio
				$item_price						=  $variation['display_regular_price'];

				echo ' <a  target="_blank" href="/gnctest/wp-admin/post.php?post='.$item->ID.'&action=edit"> SKU  '.$item_ID.'  | tipoCambio= '.$rate.'  | precio en $ '.$Dolar_number_field.'   | precio=  '.$item_price.' 	</a></br> ';

				}
			}
			echo '</br>';
			
					$i++;
					
				}
				echo '</br>_________________________________</br>';
				echo 'Total de paginas actualizadas = '.$i;
}


			
			?>




		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
