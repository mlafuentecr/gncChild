<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>


		</div>

	</div><!-- #content -->

	<?php if( is_active_sidebar( 'page-bottom' ) ){ ?>
	<div class="page-bottom">
		<div class="container">
			<?php dynamic_sidebar( 'page-bottom' ); ?>
		</div>
	</div>
	<?php } ?>

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="grid">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php
global $post;

 if( $post->ID == 7) {
	 $user 						= wp_get_current_user();
	 $varUserId 			= esc_attr( $user->cedula );
	 $varUserdate 		= esc_attr( $user->nacimiento );
	 $varUserGender 	= esc_attr( $user->genero );
	 $varUserPhone 		= esc_attr( $user->telefono );
	 $varUserAd 			= esc_attr( $user->publicidad );
 }
 ?>

<?php wp_footer(); ?>





<script>


function myPrint() {
    window.print();
}

jQuery(document).ready(function(){

				var jQuerymyDiv 		= jQuery('.woocommerce');
				var jQuerymyDivForm = jQuery('.woocommerce-EditAccountForm');

				//valida si estoy afuera del form
						 if (jQuerymyDivForm.length){

							 jQuery('#main').click(function(event){
							     validateForm();
							 });
						 }
//Clear price
jQuery( ".reset_variations" ).click(function() {
  jQuery( ".price" ).html( 'Elige una opción' );
});

//valida si estoy afuera en la pagina chekout
	 if ( jQuerymyDiv.length){


						//Fill fields I hace to send by email. client had to updaed in user detail code is in functions aditional_info_accountPg line96
						 jQuery('input#billing_myfield14').val( "<?php  	echo $varUserGender; ?>" ); //genero
						 jQuery('input#billing_myfield3').val( "<?php  		echo $varUserId; ?>" ); 		//Id
						 jQuery('input#billing_myfield4').val( "<?php  		echo $varUserdate; ?>" );	  //naciemiento
						 jQuery('input#billing_phone').val( "<?php  			echo $varUserPhone; ?>" );	//phone
						 jQuery('input#billing_myfield15c').val( "<?php  	if($varUserAd == "" ){echo 'no';}else {echo 'Si'; } ?>" );	//quiero publicidad


						 jQuery(".divTasawrap").on("input", function(){

							 if (!jQuery("#bac_tasa_zero").is(":checked")) {
									 jQuery('input#billing_myfield15').val( "(*** NO TASA 0 ***) " );
									  //alert('vacio');
							 }else {
								// alert('tasa');
									 jQuery('input#billing_myfield15').val( " (*** Compra hecha con tasa 0 a 3 meses ***) " );
							 }

					 });//divTasawrap
		}//length



});

//validateForm
function validateForm(){


	var genReg 				=  /^[Masculino]$/;
	var numberReg 		=  /^[0-9]+$/;
	var telReg 				=  /^[0-9]|[\-]+$/;
	var emailReg 			= /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	var nacimientoReg =  /^[0-9]|[\/]+$/;

	var cedula 				=jQuery('#cedula').val();
	var nacimiento 		=jQuery('#nacimiento').val();
	var genero 				=jQuery('#genero').val();
	var gen           = genero.toString();
	var tel 					=jQuery('#telefono').val();
	var turnOnSumit   = 0;



///Check Cedula
	 if (cedula.length < 7) {
				CheckErrorFn('cedula', 'errorCedula', 'Eje: 1 0907 0047'); jQuery('#cedula').css({'background': '#f4c3c3'});
	}else if(!numberReg.test(cedula)){
		   CheckErrorFn('cedula', 'errorCedula', 'Eje: 1 0907 0047');  jQuery('#cedula').css({'background': '#f4c3c3'});
	}else{
			CheckErrorFn('cedula', 'errorCedula', ''); 															jQuery('#cedula').css({'background': '#f2f2f2'});
			turnOnSumit ++;
	}


///Check Genero
	if (genero.length < 8) {
		 CheckErrorFn('genero', 'errorgenero', 'Rellenar con Masculino o Femenino'); 		jQuery('#genero').css({'background': '#f4c3c3'});
		 	turnOnSumit =0;

 }else if(gen === 'Masculino' || gen === 'Femenino' || gen === 'MASCULINO' || gen === 'FEMENINO' || gen === 'masculino' || gen === 'femenino'){
		 CheckErrorFn('genero', 'errorgenero', '');		    				    jQuery('#genero').css({'background': '#f2f2f2'});
		 turnOnSumit ++;


 }else{
		 CheckErrorFn('genero', 'errorgenero', 'Rellenar con Masculino o Femenino');  jQuery('#genero').css({'background': '#f4c3c3'});
			 turnOnSumit =0;
 }


 ///Check nacimiento
 	if (nacimiento.length < 8) {

				CheckErrorFn('nacimiento', 'errorNacimiento', ' dia/mes/año'); jQuery('#nacimiento').css({'background': '#f4c3c3'});
					turnOnSumit =0;
  }else if(!nacimientoReg.test(nacimiento)){
			 CheckErrorFn('nacimiento', 'errorNacimiento', ' dia/mes/año');   jQuery('#nacimiento').css({'background': '#f4c3c3'});
			 	turnOnSumit =0;
  }else{
			 CheckErrorFn('nacimiento', 'errorNacimiento', '');               jQuery('#nacimiento').css({'background': '#f2f2f2'});
			 turnOnSumit ++;
  }


	///Check tel
  	if (tel.length < 9) {
 				CheckErrorFn('telefono', 'errorTel', '0000-0000'); 						jQuery('#telefono').css({'background': '#f4c3c3'});
					turnOnSumit =0;
   }else if(!telReg.test(tel)){
 		  	CheckErrorFn('telefono', 'errorTel', ' 0000-0000'); 						jQuery('#telefono').css({'background': '#f4c3c3'});
				turnOnSumit =0;
   }else{
 			 CheckErrorFn('telefono', 'errorTel', '');          						  jQuery('#telefono').css({'background': '#f2f2f2'});
			 turnOnSumit ++;
   }

if(turnOnSumit === 4){
		jQuery(".button").removeAttr('disabled');
}else {
		jQuery(".button").attr('disabled','disabled');  //TurnOffSumit
}


}//Form validation end




function CheckErrorFn(whereID, errorDivname, divText) {

	if (jQuery('#'+errorDivname).length < 1) {
		 jQuery('#'+whereID).after('<span  id="'+errorDivname+'"> '+divText+' </span>');
	} else {
		jQuery('#'+whereID).text().replace('<span  id="'+errorDivname+'"> '+divText+' </span>');
	}


}



		//Change Price
		jQuery( "select" ).change(function () {

			setTimeout(function() {
				var a = jQuery('.woocommerce-variation-price').html();
				var b = jQuery('.price').html(a);
			}, 300);

		});


	var a = jQuery('.woocommerce-variation-price').html();
	var b = jQuery('.price').html(a);

	jQuery('footer.site-footer .widget_media_image img').wrap('<div class="img_hold"><div class="img_in">', '</div></div>');
	jQuery('footer.site-footer .widget_media_image .img_hold').matchHeight();
	//jQuery('#main').append('<a href="#" onclick="event.preventDefault();Tawk_API.toggle();" class="fixedChat"></a>');
	jQuery('.mega-toggle-blocks-right').append('<div class="mega-toggle-block mega-cart-block mega-toggle-block-2"><a href="<?php echo wc_get_cart_url(); ?>"><span class="mega-toggler-label">Cart (<?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>)</span></a></div>');








</script>
</body>
</html>
