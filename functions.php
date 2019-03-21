<?php
/* function marioLafuente_Index * /

//////////   System  /////////////////////////////////////
0.1      Global Variables
0.3      Prices


//////////   ACF  /////////////////////////////////////
0.4     google map ACF


//////////   WP CUSTOMIZATION ////////////////////////


1.0     Add Js Footer
1.01    Add Js header
1.2     Quita error del dom de js
1.3      Deregister CSS file
1.4      Css Call Enqueue

Customize DashBoard

1.5     Remove widgets
1.51    Remove Dashboar welcome and widgets
1.52    Customize Admin Panel
1.6     Remove submenus DashBoard
1.7     Add Dashboard menu
1.71    Add css for my menu
1.8     Add css to Dashboard


0.3      Add_theme_support except length to 20 words.
0.3.1    Add_theme_support  thumbnails
0.3.2    Add_theme_support  LOGO
0.3.3    Add_theme_support  redirection
0.3.4    Add_theme_support tags

0.3.5    Unregister Sidebar
0.3.6    Register   sidebar

Menus
0.3.6    Unregister Regular menus
0.3.7    Register menus
0.3.71   Register Walker
0.3.8    Remove menu li classs from li and add another
0.3.9    Nav_menu_link_attributes


unregister And Remove

3.1    Remove JUNK FROM HEAD
3.2    Remove All Yoast HTML Comments
3.3    Remove  ‘WordPress * is available! , boxes index
3.5   facebook metatag
3.6   html_schema



//////////   WooCommerce CUSTOMIZATION ////////////////////////
0.3.4 WooCommerce
1.2 - Customize Panel Hide items for woocommerce


//////////   others  /////////////////////////////////////
5.0 - AJAX
5.1 - For save info


//////////   Mashiur  /////////////////////////////////////
6.0 - 'gnc_setup'



//////////   System  /////////////////////////////////////


//////////   System  /////////////////////////////////////
0.1      Global Variables
0.3      Prices
//Variables el global y despues le meto el value */
global $managerOpt_Home_PgId;       $managerOpt_Home_PgId     = 51;   // esta en otros lados run search
global $managerOpt_General_PgId;    $managerOpt_General_PgId  = 154; //up 1336; //change in line 405
global $tiendasPgId;                $tiendasPgId              = 181;   //up 45;






// Add the custom field "aditional_info_accountPg"
add_action( 'woocommerce_edit_account_form', 'aditional_info_accountPgForm' );
function aditional_info_accountPgForm() {
    $user = wp_get_current_user();

    //  Cedula
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
        <label for="cedula"><?php _e( 'Cédula', 'woocommerce' ); ?>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="cedula" id="cedula" placeholder="0 0000 0000" maxlength="11" value="<?php echo esc_attr( $user->cedula ); ?>" />
    </p>
    <?php
    //  fecha nacimiento
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
        <label for="nacimiento"><?php _e( 'Fecha de nacimiento', 'woocommerce' ); ?>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="nacimiento" id="nacimiento" placeholder="dia/mes/año" maxlength="8"  value="<?php echo esc_attr( $user->nacimiento ); ?>" />
    </p>

    <?php
    //  Genero
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
        <label for="genero"><?php _e( 'Genero', 'woocommerce' ); ?>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="genero" id="genero" placeholder=" Masculino o Femenino  " maxlength="9"  value="<?php echo esc_attr( $user->genero ); ?>" />
    </p>

    <?php
    //  Teléfono
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
        <label for="telefono"><?php _e( 'Teléfono', 'woocommerce' ); ?>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="telefono" id="telefono" placeholder="0000-0000" maxlength="9"  value="<?php echo esc_attr( $user->telefono ); ?>" />
    </p>

    <?php
    //  publicidad
    ?>




  <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide publicidadWrap">

      <?php $publicidadid = esc_attr( $user->publicidad );
      if($publicidadid == "yes"){ $publicidad_checked = 'checked="checked"'; } ?>
        <input type="checkbox" name="publicidad" value="yes" <?php echo $publicidad_checked; ?> />
        <label for="publicidad" class="publicidadLabel"><?php _e( 'Acepto recibir publicidad y actualización de nuestras promociones,', 'woocommerce' ); ?>
          <a href="/condiciones-publicidad/" target="_blank">ver condiciones.</a>
    </p>

    <div class="clear"></div>
    <?php
}




// Save the custom field 'aditional_info_accountPg'
add_action( 'woocommerce_save_account_details', 'aditional_info_accountPg', 12 );
function aditional_info_accountPg( $user_id ) {

    // For cedula
    if( isset( $_POST['cedula'] ) )
    update_user_meta( $user_id, 'cedula', sanitize_text_field( $_POST['cedula'] ) );

    // For nacimiento
    if( isset( $_POST['nacimiento'] ) )
    update_user_meta( $user_id, 'nacimiento', sanitize_text_field( $_POST['nacimiento'] ) );


    // For genero
    if( isset( $_POST['genero'] ) )
    update_user_meta( $user_id, 'genero', sanitize_text_field( $_POST['genero'] ) );



    // For telefono
    if( isset( $_POST['telefono'] ) )
    update_user_meta( $user_id, 'telefono', sanitize_text_field( $_POST['telefono'] ) );



// quiero publicidad if( isset( $_POST['publicidad'] ) )
     update_user_meta($user_id, "publicidad",  sanitize_text_field( $_POST['publicidad'] ) );



}












/* 0.3.2    Add_theme_support  LOGO
-------------------------------------------------------------- */
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

function themename_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}



//////////   0.4     google map ACF

function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyCj-b02x9yJD2BTFf6jEEgNWRHuwC5Jcl0';
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');



/* 1.51    Remove Dashboar welcome and widgets
-------------------------------------------------------------- */
remove_action('welcome_panel', 'wp_welcome_panel');

function remove_dashboard_meta() {
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
    remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Removes the 'Activity' widget
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
}
add_action('admin_init', 'remove_dashboard_meta');



/*  1.52    Customize Admin Panel
-------------------------------------------------------------- */
add_action('login_head', 'marioLafuente_my_custom_logo');
   	 function marioLafuente_my_custom_logo() {
   	 echo '
   	 	<style type="text/css">
   	 	#header-logo { background-image: url('.get_stylesheet_directory_uri().'/assets/marioAdd-ons/logo.png) !important; }
   	 	</style>
   	 ';
   	 }

/* 1.6     Remove submenus DashBoard
-------------------------------------------------------------- */
add_action('login_head', 'marioLafuente_custom_login_logo');
   	 function marioLafuente_custom_login_logo() {
   	 	echo '<style type="text/css">
   	 	h1 a { background-image: url('.get_stylesheet_directory_uri().'/assets/marioAdd-ons/logo.png) !important; }
   	 	</style>';
   	 }

/* 1.7     Add Dashboard menu
-------------------------------------------------------------- */
add_action('login_head', 'marioLafuente_my_custom_login');
function marioLafuente_my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' .get_stylesheet_directory_uri(). '/assets/marioAdd-ons/login.css" />';
}

   	 // Admin footer modification
add_filter('admin_footer_text', 'marioLafuente_remove_footer_admin');
function marioLafuente_remove_footer_admin ()
{
echo '<span id="footer-thankyou">Developed by <a href="http://www.mariolafuente.com/" target="_blank">mariolafuente.com </a></span>';
}




/* 1.8     Add css to Dashboard
-------------------------------------------------------------- */
add_action( 'wp_dashboard_setup', 'marioLafuente_dashboard_widgets' );

function marioLafuente_dashboard_widgets() {
        wp_add_dashboard_widget(
            'quick-menu-access',              // Widget slug and css
            'Quick Menu Access',         // Title.
            'marioLafuente_dashboard_menu' // Display function.
        );
}


function marioLafuente_dashboard_menu() {
                echo '

      <table class="table-fill" style="width: 100%;">
       <thead>
          <tr>
             <th class="text-left" style="width: 80%;" colspan="2">Options Menu</th>
          </tr>
       </thead>
       <tbody class="table-hover">

       <tr>
          <td class="text-left" style="width: 80%;">
             <h4>Productos</h4>
          </td>
          <td class="text-left" style="width: 20%;"><a href="'.  esc_url( home_url( '/wp-admin/edit.php?post_type=product' ) )  .'" target="_blank" rel="noopener">Abrir</a></td>
       </tr>
       <tr>
          <td class="text-left" style="width: 80%;">
             <h4>Exportar Usuarios</h4>
          </td>
          <td class="text-left" style="width: 20%;"><a href="'.  esc_url( home_url( '/wp-admin/export.php' ) )  .'" target="_blank" rel="noopener">Abrir</a></td>
       </tr>

          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>Modificar Tipo de cambio y Refrescar precios</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="'.  esc_url( home_url( '/wp-admin/options-general.php?page=gnc_storefront' ) )  .'" target="_blank" rel="noopener">Abrir</a></td>
          </tr>

          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>Modificar Terminos de Carrito de compra</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="'.  esc_url( home_url( '/wp-admin/post.php?post=1136&action=edit' ) )  .'" target="_blank" rel="noopener">Abrir</a></td>
          </tr>


 

          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>Modificar Pg Principal</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="'. esc_url( home_url( '/wp-admin/post.php?post=51&amp;action=edit' ) ) .'" target="_blank" rel="noopener">Abrir</a></td>
          </tr>
          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>Modificar headlines</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="' . esc_url( home_url( '/wp-admin/admin.php?page=revslider' ) ) .'" target="_blank" rel="noopener">Abrir</a></td>
          </tr>
          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>Modificar Menus</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="' .esc_url( home_url( '/wp-admin/nav-menus.php' ) ) . '" target="_blank" rel="noopener">Abrir</a></td>
          </tr>
          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>Modificar Footer Sidebar y mas</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="' . esc_url( home_url( '/wp-admin/widgets.php' ) ) .'" target="_blank" rel="noopener">Abrir</a></td>
          </tr>
          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>Listado de Clientes</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="'.  esc_url( home_url( '/wp-admin/admin.php?page=wc-reports&tab=customers&report=customer_list' ) )  .'" target="_blank" rel="noopener">Abrir</a></td>
          </tr>
          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>Listado de venta de este mes</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="'.  esc_url( home_url( '/wp-admin/admin.php?page=wc-reports&tab=orders&range=month' ) )  .'" target="_blank" rel="noopener">Abrir</a></td>
          </tr>
          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>Loguearse al chat</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="'.  esc_url( home_url( '/wp-admin/options-general.php?page=tawkto_plugin&override=1' ) )  .'" target="_blank" rel="noopener">Abrir</a></td>
          </tr>
          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>BAC PAYMENT GATEWAY</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="'.  esc_url( home_url( '/wp-admin/admin.php?page=wc-settings&tab=checkout&section=credomatic' ) )  .'" target="_blank" rel="noopener">Abrir</a></td>
          </tr>
          <tr>
             <td class="text-left" style="width: 80%;">
                <h4>>Abrir Credomaic</h4>
             </td>
             <td class="text-left" style="width: 20%;"><a href="https://credomatic.compassmerchantsolutions.com/merchants/reports.php?tid=8929b12071bf3d23f3a3337e36ef3996" target="_blank" rel="noopener">Abrir</a></td>
          </tr>
       </tbody>
    </table>

                ';
}


/* 1.71    Add css for my menu
-------------------------------------------------------------- */
add_action('admin_head', 'marioLafuente_menu_dashboar_style');
function marioLafuente_menu_dashboar_style() {
      echo '
      <style>
      .update-nag {
    display: none;
}



      ul.wf-block-list > li:nth-child(3) { display: none!important; }
      .table-fill,div.table-title{margin:auto;max-width:600px;padding:5px;width:100%}.table-fill td,.table-fill th{vertical-align:middle;text-align:left}.table-title h3,td{text-shadow:-1px -1px 1px rgba(0,0,0,.1)}.table-fill td,.table-fill th.text-left,th{text-align:left}div.table-title{display:block}.table-title h3{color:#fafafa;font-size:30px;font-weight:400;font-style:normal;font-family:Roboto,helvetica,arial,sans-serif;text-transform:uppercase}.table-fill{background:#fff;border-radius:3px;border-collapse:collapse;height:320px;box-shadow:0 5px 10px rgba(0,0,0,.1);animation:float 5s infinite}.table-fill tr:hover td,.table-fill tr:nth-child(odd):hover td{background:#ffbebe}.table-fill th{border-bottom:4px solid #9ea7af;border-right:1px solid #343a45;font-size:23px;font-weight:100;padding:24px;text-shadow:0 1px 1px rgba(0,0,0,.1)}.table-fill th:first-child{border-top-left-radius:3px}.table-fill th:last-child{border-top-right-radius:3px;border-right:none}.table-fill tr{border-top:1px solid #C1C3D1;border-bottom-:1px solid #C1C3D1;color:#666B85;font-size:16px;font-weight:400;text-shadow:0 1px 1px rgba(256,256,256,.1)}.table-fill tr:hover td{color:#FFF;border-top:1px solid #22262e;border-bottom:1px solid #22262e}.table-fill tr:first-child{border-top:none}.table-fill tr:last-child{border-bottom:none}.table-fill tr:nth-child(odd) td{background:#EBEBEB}.table-fill tr:last-child td:first-child{border-bottom-left-radius:3px}.table-fill tr:last-child td:last-child{border-bottom-right-radius:3px}.table-fill td{background:#FFF;padding:5px;font-weight:300;font-size:18px;border-right:1px solid #C1C3D1}.table-fill td:last-child{border-right:0}.table-fill th.text-center{text-align:center}.table-fill th.text-right{text-align:right}.table-fill td.text-left{text-align:left}.table-fill td.text-center{text-align:center}.table-fill td.text-right{text-align:right} }
      </style>';
}

	 /* 2.0 - Customize Admin Panel
	 -------------------------------------------------------------- */
add_action( 'admin_head', 'marioLafuente_custom_admin_Dash' );
   	 function marioLafuente_custom_admin_Dash(){

   	     echo '
              <style type="text/css"> #wpfooter{position:inherit;bottom:0;left:0;right:0;padding:10px 20px;color:#555d66;width:20%;margin-left:auto;margin-right:auto}
              #wpwrap { background-image: url('.get_stylesheet_directory_uri().'/assets/marioAdd-ons/logo.png) !important; background-repeat: no-repeat; background-position: top; padding-top: 80px!important; }
              #quick-menu-access,.wp-admin.toplevel_page_jetpack{background-color:#fff!important}#wp-admin-bar-wp-logo,.load-customize,a.button.hide-if-no-customize,a.page-title-action.hide-if-no-customize,tr.user-admin-color-wrap{display:none}.plugin-card{width:30%;width:calc(49.1% - 8px)}input#save{color:red;background-color:red!important}#adminmenu .wp-submenu a{color:#dc3232}div#adminmenumain{border-top:solid gray 10px;margin-top:20px}#adminmenuback{bottom:unset}.postbox .inside h2,.wrap [class$=icon32]+h2,.wrap h1,.wrap>h2:first-child{color:#fff}body{background:#fff}.wp-core-ui .button-primary{background:#dc3232;border-color:#dc3232;box-shadow:0 1px 0 #400b0b;color:#fff;text-decoration:none;text-shadow:none}.wrap .wp-heading-inline+.page-title-action,a{color:#dc3232}#wpadminbar{background:grey!important}#adminmenu .opensub .wp-submenu li.current a,#adminmenu .wp-submenu li.current,#adminmenu .wp-submenu li.current a,#adminmenu .wp-submenu li.current a:focus,#adminmenu .wp-submenu li.current a:hover,#adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a{color:#b4b9be}#adminmenu .wp-has-current-submenu .wp-submenu,#adminmenu .wp-has-current-submenu .wp-submenu.sub-open,#adminmenu .wp-has-current-submenu.opensub .wp-submenu,#adminmenu a.wp-has-current-submenu:focus+.wp-submenu,.no-js li.wp-has-current-submenu:hover .wp-submenu{background-color:#fff}#adminmenu li.menu-top:hover,#adminmenu li.opensub>a.menu-top,#adminmenu li>a.menu-top:focus{background-color:red;color:#fff}#wpadminbar .ab-top-menu>li.hover>.ab-item,#wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus,#wpadminbar:not(.mobile) .ab-top-menu>li:hover>.ab-item,#wpadminbar:not(.mobile) .ab-top-menu>li>.ab-item:focus{background:#dc3232;color:#fff}.metabox-holder .postbox-container .empty-container{border:3px dashed #f3f3f3}#wpadminbar .menupop .ab-sub-wrapper,#wpadminbar .shortlink-input{background:#dc3232}#adminmenu li a:focus div.wp-menu-image:before,#adminmenu li.opensub div.wp-menu-image:before,#adminmenu li:hover div.wp-menu-image:before{color:#fff}#adminmenu li.wp-has-submenu.wp-not-current-submenu.opensub:hover:after{border-right-color:transparent}#adminmenu .wp-submenu a:focus,#adminmenu .wp-submenu a:hover,#adminmenu a:hover,#adminmenu li.menu-top>a:focus{color:#f5a2a2}#adminmenu div.wp-menu-image:before{color:#b4b9be}#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head,#adminmenu .wp-menu-arrow,#adminmenu .wp-menu-arrow div,#adminmenu li.current a.menu-top,#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu,.folded #adminmenu li.current.menu-top,.folded #adminmenu li.wp-has-current-submenu{background:grey;color:#b4b9be}header-logo{background-image:url(your_logo_path_here)!important}#adminmenu a{color:#444}#adminmenu,#adminmenu .wp-submenu,#adminmenuback,#adminmenuwrap{width:160px;background-color:#fff}@media (min-width:575.98px){#wpwrap{width:80%!important;padding:0 10%}}
              </style>
   	     ';
   	 }





		 //////////   WooCommerce CUSTOMIZATION ////////////////////////


		 /* 1.2 - Customize Panel Hide items for woocommerce
		 -------------------------------------------------------------- */

		 function my_customize_register() {
		 global $wp_customize;
		 echo '    <style type="text/css">

		  #accordion-section-header_image, #accordion-section-storefront_footer, #accordion-section-background_image, #accordion-section-storefront_typography,
		  #accordion-section-storefront_buttons, #accordion-section-storefront_layout{
		     display: none!important;
		 }
		 .wp-core-ui .button-primary-disabled, .wp-core-ui .button-primary.disabled, .wp-core-ui .button-primary:disabled, .wp-core-ui .button-primary[disabled] {
		     color: white!important;
		     background: #dc3232!important;
		     border-color: #dc3232!important;}
		 </style>
		 ';
		 }

		 add_action( 'customize_register', 'my_customize_register', 11 );


     /* 3.0     //Reposition WooCommerce breadcrumb
		 	 -------------------------------------------------------------- */



     add_action( 'init', 'wc_remove_storefront_breadcrumbs');
     function wc_remove_storefront_breadcrumbs() {
       remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
     }

     add_action( 'init', 'wc_add_storefront_breadcrumbs');
     function wc_add_storefront_breadcrumbs() {
       add_action( 'storefront_content_top', 'woocommerce_breadcrumb', 10 );
     }


     add_action( 'init', 'woo_remove_wc_breadcrumbs' );
     function woo_remove_wc_breadcrumbs() {
         remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
     }




		 	 /* 3.1    Remove JUNK FROM HEAD
		 	 -------------------------------------------------------------- */

		 	 // Removes the wlwmanifest link
		 	 remove_action( 'wp_head', 'wlwmanifest_link' );
		 	 // Removes the RSD link
		 	 remove_action( 'wp_head', 'rsd_link' );
		 	 // Removes the WP shortlink
		 	 remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		 	 // Removes the canonical links
		 	 remove_action( 'wp_head', 'rel_canonical' );
		 	 // Removes the links to the extra feeds such as category feeds
		 	 remove_action( 'wp_head', 'feed_links_extra', 3 );
		 	 // Removes links to the general feeds: Post and Comment Feed
		 	 remove_action( 'wp_head', 'feed_links', 2 );
		 	 // Removes the index link
		 	 remove_action( 'wp_head', 'index_rel_link' );
		 	 // Removes the prev link
		 	 remove_action( 'wp_head', 'parent_post_rel_link' );
		 	 // Removes the start link
		 	 remove_action( 'wp_head', 'start_post_rel_link' );
		 	 // Removes the relational links for the posts adjacent to the current post
		 	 remove_action( 'wp_head', 'adjacent_posts_rel_link' );
		 	 remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
		 	 // Removes the WordPress version i.e. -
		 	 remove_action( 'wp_head', 'wp_generator' );

		 	 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		 	 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		 	 remove_action( 'wp_print_styles', 'print_emoji_styles' );
		 	 remove_action( 'admin_print_styles', 'print_emoji_styles' );


			 /* 3.0    remove_version,  ‘WordPress * is available! , boxes index
			  	 -------------------------------------------------------------- */

			 /*** Remove Apperance */

			  function remove_submenus() {
			    global $submenu;
			    //Dashboard menu
			    unset($submenu['index.php'][10]); // Removes Updates
			    //Posts menu
			    //unset($submenu['edit.php'][5]); // Leads to listing of available posts to edit
			    //unset($submenu['edit.php'][10]); // Add new post
			    //unset($submenu['edit.php'][15]); // Remove categories
			    //unset($submenu['edit.php'][16]); // Removes Post Tags

			    //Media Menu
			    //unset($submenu['upload.php'][5]); // View the Media library
			    //unset($submenu['upload.php'][10]); // Add to Media library

			    //Links Menu
			    //unset($submenu['link-manager.php'][5]); // Link manager
			    //unset($submenu['link-manager.php'][10]); // Add new link
			    //unset($submenu['link-manager.php'][15]); // Link Categories

			    //Pages Menu
			   // unset($submenu['edit.php?post_type=page'][5]); // The Pages listing
			    //unset($submenu['edit.php?post_type=page'][10]); // Add New page

			    //Appearance Menu
			   // unset($submenu['themes.php'][5]); // Removes 'Themes'
			    //unset($submenu['themes.php'][7]); // Widgets
			    unset($submenu['themes.php'][15]); // Removes Theme Installer tab
			    unset($submenu['themes.php'][20]); //Background
			    //unset($submenu['themes.php'][6]); // Customize

			    //Plugins Menu
			    //unset($submenu['plugins.php'][5]); // Plugin Manager
			    //unset($submenu['plugins.php'][10]); // Add New Plugins
			    //unset($submenu['plugins.php'][15]); // Plugin Editor

			    //Users Menu
			    //unset($submenu['users.php'][5]); // Users list
			    //unset($submenu['users.php'][10]); // Add new user
			    //unset($submenu['users.php'][15]); // Edit your profile

			    //Tools Menu
			    //unset($submenu['tools.php'][5]); // Tools area
			    //unset($submenu['tools.php'][10]); // Import
			    //unset($submenu['tools.php'][15]); // Export
			    //unset($submenu['tools.php'][20]); // Upgrade plugins and core files

			    //Settings Menu
			   // unset($submenu['options-general.php'][10]); // General Options
			   // unset($submenu['options-general.php'][15]); // Writing
			    //unset($submenu['options-general.php'][20]); // Reading
			    //unset($submenu['options-general.php'][25]); // Discussion
			    //unset($submenu['options-general.php'][30]); // Media
			    //unset($submenu['options-general.php'][35]); // Privacy
			    //unset($submenu['options-general.php'][40]); // Permalinks
			    //unset($submenu['options-general.php'][45]); // Misc
			  }
			  add_action('admin_menu', 'remove_submenus');































/* 6.0     'gnc_setup'
		 -------------------------------------------------------------- */


if ( ! function_exists( 'gnc_setup' ) ) :

	function gnc_setup() {

		load_theme_textdomain( 'gnc', get_stylesheet_directory_uri() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-main' => esc_html__( 'Main Menu', 'gnc' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'customize-selective-refresh-widgets' );


	}

endif;
add_action( 'after_setup_theme', 'gnc_setup' );





/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gnc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Search', 'gnc' ),
		'id'            => 'header-search',
		'description'   => esc_html__( 'Add widgets here.', 'gnc' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Cart', 'gnc' ),
		'id'            => 'quick-cart',
		'description'   => esc_html__( 'Add widgets here.', 'gnc' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Bottom', 'gnc' ),
		'id'            => 'page-bottom',
		'description'   => esc_html__( 'Add widgets here.', 'gnc' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'gnc' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'gnc' ),
		'before_widget' => '<div id="%1$s" class="widget grid__item one-sixth %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'gnc_widgets_init' );

function gnc_scripts() {



	wp_enqueue_style( 'gnc-fonts', get_stylesheet_directory_uri() . '/assets/fonts/fonts.css' );

	wp_enqueue_style( 'gnc-style', get_stylesheet_uri() , array() , '20151215' );

	wp_enqueue_script( 'gnc-matchHeight', get_stylesheet_directory_uri() .'/assets/js/jquery.matchHeight-min.js', array('jquery'), '20151215', true );


	wp_enqueue_script( 'gnc-isotope', get_stylesheet_directory_uri() .'/assets/js/isotope.pkgd.js', array('jquery'), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'gnc_scripts' );


function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}


// Add the filter and function, returning the widget title only if the first character is not "!"
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
	if ( substr ( $widget_title, 0, 1 ) == '!' )
		return;
	else
		return ( $widget_title );
}

// Override theme default specification for product # per row
function loop_columns() {
return 5; // 5 products per row
}
add_filter('loop_shop_columns', 'loop_columns', 999);

function gnc_notitle(){
	return false;
}

add_filter( 'woocommerce_show_page_title', 'gnc_notitle' , 5 );

function gnc_t_container_start(){
	if(is_shop() || is_product_category()){
	echo '<div class="shop_header"><div class="container">';
	echo '<h1 class="woocommerce-products-header__title page-title">';
	woocommerce_page_title();
	echo '</h1>';
	}
}

add_action( 'storefront_content_top',             'gnc_t_container_start',                   5 );


function gnc_t_container_end(){
	if(is_shop() || is_product_category()){
	echo '</div></div>';
	}
}

add_action( 'storefront_content_top',             'gnc_t_container_end',                   999 );
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering' , 55 );
add_action( 'storefront_content_top' , 'woocommerce_catalog_ordering' , 7 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );


///////////////////////////////////////////////////////
////////////////// gnc_currency_add_admin_menu /////////

add_action( 'admin_menu', 'gnc_currency_add_admin_menu' );
function gnc_currency_add_admin_menu(  ) {

	add_options_page( 'Exchange Rate', 'Exchange Rate', 'manage_options', 'gnc_storefront', 'gnc_currency_options_page' );

}


//Terminos y condiciones jalados desde nivel_de_proteccion
add_action( 'woocommerce_checkout_after_terms_and_conditions', 'Terminos_de_Uso' );

function Terminos_de_Uso() {
		$nivel_de_proteccion = get_field('nivel_de_proteccion', 1136);
    echo '<span class="woocommerce-terms-and-conditions-checkbox-text2">He leído y acepto <a href="/terminos/" class="woocommerce-terms-and-conditions-link2" target="_blank">Ver Terminos y condiciones</a> <br> <a href="/tiempos-de-entrega/" class="woocommerce-terms-and-conditions-link2" target="_blank">/ Ver tiempos de Entrega</a></span>';
echo '<div class="terminosWrap" style=" height:120px;width:405px;border:1px solid #ccc;font:16px/26px;overflow:auto;">
'.$nivel_de_proteccion.'
</div><a style="margin: 5px 0px" href="/politica-de-privacidad/" target="blank">Ver políticas de privacidad</a>';
}




add_action( 'admin_init', 'gnc_currency_settings_init' );
function gnc_currency_settings_init(  ) {

	register_setting( 'pluginPage', 'gnc_currency_settings' );

	add_settings_section(
		'gnc_currency_pluginPage_section',
      __( 'USD To Colon Exchange Rate <h2>Pasos: </h2> <br> 1 Guardar tipo de Cambio <br> 
      2 Ir a la pagina de refrescar precios <a href="/gnctest/run-dollar-product-price-update/"   target="_blank"> Refrescar todos los precios (gnctest) </a>  ', 'gnc_storefront' ),
		'gnc_currency_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'gnc_currency_text_field_0',
		__( 'Exchange Rate', 'gnc_storefront' ),
		'gnc_currency_text_field_0_render',
		'pluginPage',
		'gnc_currency_pluginPage_section'
	);


}


function gnc_currency_text_field_0_render(  ) {

	$options = get_option( 'gnc_currency_settings' );
	?>
	<input type='text' name='gnc_currency_settings[gnc_currency_text_field_0]' value='<?php echo $options['gnc_currency_text_field_0']; ?>'>
	<?php

}


function gnc_currency_settings_section_callback(  ) {

	echo __( '&nbsp;', 'gnc_storefront' );

}


function gnc_currency_options_page(  ) {

	?>
	<form action='options.php' method='post'>

		<h2></h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}










//quito el defaulth de enviar diferente direccion
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );



// Billing Fields.
//add_filter( 'woocommerce_billing_fields' , 'woocommerce_billing_fields_custom' );

function woocommerce_billing_fields_custom( $fields ) {
	//$fields['billing_phone']['required'] = false;
	$fields['billing_phone']['maxlength'] = 10;

  $fields['billing_email']['class'] = array('form-row-first');
  $fields['billing_phone']['class'] = array('form-row-last');

    $fields['billing_postcode']['class'] = array('form-row-last');
   $fields['billing_company']['class'] = array('form-row-first');

   $fields['billing_country']['class'] = array('form-row-first');
   $fields['billing_state']['class'] = array('form-row-last');

	//Order Billing fields
	$fields['billing_email']['priority'] = 30;
	$fields['billing_phone']['priority'] = 31;
  $fields['billing_company']['priority'] = 32;
  $fields['billing_postcode']['priority'] = 32;

	$fields['billing_country']['priority'] = 70;
  	$fields['billing_state']['priority'] = 71;
	$fields['billing_city']['priority'] = 72;


	$fields['billing_address_1']['priority'] = 100;
  $fields['billing_address_2']['priority'] = 100;
	return $fields;


}

//add_filter( 'woocommerce_default_address_fields', 'woocommerce_default_address_fields_reorder' );

function woocommerce_default_address_fields_reorder( $fields ) {
  $fields['company']['required'] = false;
  $fields['postcode']['required'] = false;

  	$fields['country']['priority'] = 70;
    $fields['state']['priority'] = 71;
    $fields['city']['priority'] = 72;

	$fields['address_1']['priority'] = 80;
	$fields['address_2']['priority'] = 90;
  $fields['postcode']['priority'] = 33;

	return $fields;
}





add_filter( 'woocommerce_checkout_fields' , 'custom_remove_woo_checkout_fields' );

function custom_remove_woo_checkout_fields( $fields ) {

    // remove billing fields
    // unset($fields['billing']['billing_first_name']);
    // unset($fields['billing']['billing_last_name']);
    // unset($fields['billing']['billing_company']);
    // unset($fields['billing']['billing_address_1']);
    // unset($fields['billing']['billing_address_2']);
    // unset($fields['billing']['billing_city']);
    //unset($fields['billing']['billing_postcode']);
    // unset($fields['billing']['billing_country']);
    // unset($fields['billing']['billing_state']);
    // unset($fields['billing']['billing_phone']);
    // unset($fields['billing']['billing_email']);

    // remove shipping fields
    // unset($fields['shipping']['shipping_first_name']);
    // unset($fields['shipping']['shipping_last_name']);
    // unset($fields['shipping']['shipping_company']);
    // unset($fields['shipping']['shipping_address_1']);
    // unset($fields['shipping']['shipping_address_2']);
    // unset($fields['shipping']['shipping_city']);
    //unset($fields['shipping']['shipping_postcode']);
    // unset($fields['shipping']['shipping_country']);
    // unset($fields['shipping']['shipping_state']);

    // remove order comment fields
    unset($fields['order']['order_comments']);

    return $fields;
}



add_action( 'woocommerce_thankyou', 'custom_content_thankyou', 10, 1 );
function custom_content_thankyou( $order_id ) {

    echo '<button onclick="myPrint()">Imprimir</button>';
}



///////////////////////////////////////////////////////
//////////////////Variable Product costume //////////////


//Remuevo de producto con variable la data
function mytheme_show_product_variations(){
	global $product;

		if( $product->is_type('variable') ) {
			// Add the hook back in that was removed, when looking at Variations

      // Disable the hooks so that their order can be changed.
    //   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    //   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    //   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    //   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    //   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    //   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    //   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
       remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10);
    //
		// 	//  Add to Cart on Variation
    //   add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    //   add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    //   add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    //   //add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    //   add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 6 );
    //   //add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    // //  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
     add_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 60);
   }else {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 50 );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
    }
}

add_action( 'woocommerce_before_single_product', 'mytheme_show_product_variations' );





///////////////////////////////////////////////////////
//////////////////Single Product costume //////////////

/** * Remove product data tabs Sigle Product*/
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}

///Add description Again to single product
function woocommerce_template_product_description() {
  	global $product;
  	if( $product->is_type('simple') ) {
  woocommerce_get_template( 'single-product/tabs/description.php' );
}
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 50 );

//
// // add the action
// add_action( 'woocommerce_after_single_variation', 'action_woocommerce_after_single_variation', 10, 0 );
//
//
// // add the action
// add_action( 'woocommerce_before_single_variation', 'action_woocommerce_before_single_variation', 10, 0 );

// define the woocommerce_before_single_variation callback
function action_woocommerce_before_single_variation(  ) {
}

// define the woocommerce_before_single_variation callback
function action_woocommerce_after_single_variation(  ) {

}

///remove the heading title s
add_filter('woocommerce_product_description_heading',
'sam_product_description_heading');

function sam_product_description_heading() {
    return '';
}








// all variations same price. WooCommerce default behavior No muestra precios con esto si.
//add_filter('woocommerce_show_variation_price',      function() { return TRUE;});





////////////////////////////////////////////////////////
///////////// PICESES IN Dollar and Colones ////////////





////////////////////////////////////////////////////////
///////////////////// Product Single ///////////////////
//1 Add Field to  ////////////////// Single
 add_action( 'woocommerce_product_options_pricing', 'regular_Price' );


// ////////////////////////////////////////////////////////
// ///////////////////// Product Variation ////////////////
// //2  Add FIELDS to /////////////// Variation
add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );



// //1 Save Data / Save the custom field
add_action( 'save_post', 'WC_Save_product' );
//add_action( 'woocommerce_process_product_meta', 'WC_Save_product' );




//Meto campos de producto simple
function regular_Price( $array   ) {
	global $post;
  // Get currency conversion rate from settings
  $currentcy_settings = get_option( 'gnc_currency_settings' );
  $rate = $currentcy_settings[gnc_currency_text_field_0];


  // Text Field
  echo '<p class="form-row col-3 firstCol dolarRate">'.'Tipo de cambio = $'.$rate. '</p>';
  // Text Field
  echo '<p class="form-row col-3 firstCol  divchangeDolar"> <a href="/wp-admin/options-general.php?page=gnc_storefront" target="_blank">Modificar tipo de cambio</a></p>';
  // Number Field Dolares regular price

	woocommerce_wp_text_input(
		// Number Field Dolares regular price
				array(
					  'id'          	=> '_dolar_price_field',
						'value'         => get_post_meta( $post->ID, '_dolar_price_field', true ),
						'label'         => __( 'Precio en dolares', 'woocommerce' ),
						'desc_tip'      => true,
						'description'   => __( 'ponga el precio en dolares del producto', 'woocommerce' ),
						'wrapper_class' => 'divRegularPrice',
						'data_type' => 'price' //Let WooCommerce formats our field as price field
				)
		);

	// Number Field Dolares regular price
	woocommerce_wp_text_input(
				array(
						'id'            => '_dolar_price_field_sale',
						'value'         => get_post_meta( $post->ID, '_dolar_price_field_sale', true ),
						'label'         => __( 'Promocion en dolares', 'woocommerce' ),
						'desc_tip'      => true,
						'description'   => __( 'ponga la promocion en dolares del producto', 'woocommerce' ),
						'wrapper_class' => 'divSalePrice',
						'data_type' => 'price' //Let WooCommerce formats our field as price field
				)
		);

 


  echo '
<style type="text/css">
.divRegularPrice label,.divSalePrice label,p.form-field._regular_price_field label,p.form-field._sale_price_field label{width:100%!important;text-align:center}p.form-field._regular_price_field,p.form-field._sale_price_field{float:left;width:40%;margin:10px;text-align:center;justify-content:center;display:flex;flex-wrap:wrap}.woocommerce_options_panel label,.woocommerce_options_panel legend{float:none;width:auto;padding:0;margin:0}.woocommerce_options_panel fieldset.form-field,.woocommerce_options_panel p.form-field{padding:0!important}p.form-row.form-row-full.options{margin-bottom:70px!important}.options_group.pricing.show_if_simple{margin-top:70px!important}.show_if_simple,.woocommerce_variable_attributes{position:relative!important}.divRegularPrice,.divSalePrice,.divchangeDolar,.dolarRate{position:absolute;display:flex;padding:0!important;margin:0!important;top:-70px;height:70px}.dolarRate{width:20%;justify-content:center;align-items:center;flex-wrap:wrap;background-color:#fdff97;text-align:center;left:0}.divRegularPrice,.divSalePrice{width:30%!important;justify-content:center;background-color:#f5f6e4}.divRegularPrice{align-items:center;flex-wrap:wrap;left:20%}.divSalePrice{align-items:center;flex-wrap:wrap;left:50%}.divchangeDolar{width:20%!important;justify-content:center;align-items:center;flex-wrap:wrap;background-color:#fdff97;text-align:center;left:80%}.woocommerce_variable_attributes .divRegularPrice,.woocommerce_variable_attributes .divSalePrice,.woocommerce_variable_attributes .divchangeDolar,.woocommerce_variable_attributes .dolarRate{top:140px}
  </style>
  ';

}



	//reference https://codex.wordpress.org/Function_Reference/wp_update_post
	// unhook this function so it doesn't loop infinitely


function variation_settings_fields( $loop, $variation_data, $variation ) {

			// Get currency conversion rate from settings
			$currentcy_settings = get_option( 'gnc_currency_settings' );
			$rate = $currentcy_settings[gnc_currency_text_field_0];
		
			
			// Text Field
			echo '<p class="form-row col-3 firstCol dolarRate">'.'Tipo de cambio = $'.$rate. '</p>';
			// Text Field
			echo '<p class="form-row col-3 firstCol  divchangeDolar"> <a href="/wp-admin/options-general.php?page=gnc_storefront" target="_blank">Modificar tipo de cambio</a></p>';
		
    woocommerce_wp_text_input(
        array(
						'id'            => "_dolar_price_field{$loop}",
						'name'          => "_dolar_price_field[{$loop}]",
            'value'         => get_post_meta( $variation->ID,  '_dolar_price_field', true ),
            'label'         => __( 'Precio en dolares', 'woocommerce' ),
            'desc_tip'      => true,
            'description'   => __( 'ponga el precio en dolares ', 'woocommerce' ),
            'wrapper_class' => 'divRegularPrice',
        )
		);
		
		woocommerce_wp_text_input(
			array(
					'id'            => "_dolar_price_field_sale{$loop}",
					'name'          => "_dolar_price_field_sale[{$loop}]",
					'value'         => get_post_meta( $variation->ID, '_dolar_price_field_sale', true ),
					'label'         => __( 'Promocion en dolares', 'woocommerce' ),
					'desc_tip'      => true,
					'description'   => __( 'ponga la promocion en dolares del producto', 'woocommerce' ),
					'wrapper_class' => 'divSalePrice',
			)
	);

}

function save_variation_settings_fields( $variation_id, $loop ) {
	remove_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );

	$dolar_field 		  = $_POST['_dolar_price_field'][ $loop ];
	$dolareSale_field = $_POST['_dolar_price_field_sale'][ $loop ];

	if ( ! empty( $dolar_field ) ) {
			update_post_meta( $variation_id, '_dolar_price_field', esc_attr( $dolar_field ));
			//die(print_r('dolar lleno Variacion'.$dolar_field ));
	}else{
	//	die(print_r('dolar vacio Variacion'));
	}

	if ( ! empty( $dolareSale_field ) ) {
		update_post_meta( $variation_id, '_dolar_price_field_sale', esc_attr( $dolareSale_field ));
}

add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );

}


	
function WC_Save_product($post_id) {
	
	remove_action( 'save_post', 'WC_Save_product' );
	global $post;
	// Only for product post type
if( $post->post_type == 'product' ){
	$product 						= wc_get_product( $post_id );
	$type 							= $product->get_type();
	$currentcy_settings = get_option( 'gnc_currency_settings' );
	$rate 							= $currentcy_settings[gnc_currency_text_field_0];
	//$rate 						= array_values($currentcy_settings)[0]; 
}


	if( $type == 'simple' ){ 
		
		////////////  1. Get
			$regular_price 				 = isset( $_POST['_regular_price'] ) ? $_POST['_regular_price'] : '';
			$sales_price 					 = isset( $_POST['_sale_price'] ) ? $_POST['_sale_price'] : '';
			$dolar_price_field 		 = isset( $_POST['_dolar_price_field'] ) ? $_POST['_dolar_price_field'] : '';
			$dolarSale_price_field = isset( $_POST['_dolar_price_field_sale'] ) ? $_POST['_dolar_price_field_sale'] : '';

			// 		//Check if price is 0
			// 	$postToPrivate = array( 'ID' => $post_id, 'post_status' => 'private', );

			// if($regular_price == 'Array' || $regular_price == '' || $regular_price <= 0){
			// 	update_post_meta($item_ID, '_regular_price', 		0);
			// 	wp_update_post( $postToPrivate );
			// }

		// Dolares presente
		if($dolar_price_field <= 0 ){
			//$dolar_price_field lo limpio y salvo abajo
			$dolar_price_field = ''; 
		}elseif( ! empty( $dolar_price_field ) ){
			 $regular_price = round($dolar_price_field * $rate);
			//$dolar_price_field se queda igual y se salva abajo
		}

		//Promocion Dolares presente
		if($dolarSale_price_field <= 0 ){
			$dolarSale_price_field = '';
		}elseif (! empty( $dolarSale_price_field ) &&  ! empty( $dolar_price_field )){
			$sales_price	 = round($dolarSale_price_field * $rate);
			//$dolarSale_price_field se queda igual y se salva abajo
		}


		update_post_meta($post_id, '_dolar_price_field', 			$dolar_price_field);
		update_post_meta($post_id, '_dolar_price_field_sale', $dolarSale_price_field);

		update_post_meta($post_id, '_sale_price', 					  $sales_price);
		update_post_meta($post_id, '_regular_price', 					$regular_price);
		update_post_meta($post_id, '_price', 									$regular_price);

	
wc_delete_product_transients( $post_id );

	}//End simple save


	/////Variable SAVE
	if( $type == 'variable' ){ 
	
		// die(print_r('dolar= '.$dolar_price_field.' regular_price='.$regular_price));

		//get the variable id
		$variable_post_ids = $_POST['variable_post_id'];
		$i = 0;
		foreach( $variable_post_ids as $item_ID){
		
		
			$meta[$item_ID] 					= get_post_meta($item_ID, '', true);
			$dolar_price_fieldArray 	= isset( $_POST['_dolar_price_field'] ) ? $_POST['_dolar_price_field'] : '';
			$dolar_Sale_fieldArray 		= isset( $_POST['_dolar_price_field_sale'] ) ? $_POST['_dolar_price_field_sale'] : '';

		
	
					// Dolares presente
		if($dolar_price_fieldArray[$i] <= 0 || empty( $dolar_price_fieldArray[$i]  )){
			update_post_meta( $item_ID, '_dolar_price_field', '');
		}elseif( ! empty( $dolar_price_fieldArray[$i] )){
			$regular_price_mof[$i] = round($dolar_price_fieldArray[$i] * $rate);
			//die(print_r($item_ID.''.$regular_price_mof[$i]));
					update_post_meta( $item_ID, '_regular_price', $regular_price_mof[$i]);
					update_post_meta($item_ID, '_price', 					$regular_price_mof[$i]);
		}

		//Promocion Dolares presente
		if($dolar_Sale_fieldArray[$i] <= 0 ){
			update_post_meta( $item_ID, '_dolar_price_field_sale', '');
		}elseif (! empty( $dolar_Sale_fieldArray[$i]  ) &&  ! empty( $dolar_price_fieldArray[$i] )){
			$sales_price[$i]	 = round($dolar_Sale_fieldArray[$i] * $rate);
			update_post_meta( $item_ID, '_sale_price', $sales_price[$i]);
		}

			$i++;
		}


			// //Check if price is 0
			// $postToPrivate = array( 'ID' => $post_id, 'post_status' => 'private', );

			// if($dolar_price_fieldArray[$i] == 'Array' || $dolar_price_fieldArray[$i] == '' || $dolar_price_fieldArray[$i] <= 0 ){
			// 	update_post_meta($item_ID, '_regular_price', 		0);
			// 	wp_update_post( $postToPrivate );
			// }

	
	}
		

add_action( 'save_post', 'WC_Save_product' );
 
}





