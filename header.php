<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<?php wp_head(); ?>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136415067-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-136415067-1');
</script>

</head>

<body <?php body_class(); ?>>

<?php do_action( 'storefront_before_site' ); ?>


<div id="page" class="site">

	<?php do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="header-top clearfix">

				<div class="site-branding">
					<?php
					the_custom_logo();
					?>
				</div><!-- .site-branding -->

				<div class="colRight">
				<div class="header-search">
					<?php dynamic_sidebar( 'header-search' ); ?>
				</div>

				<div class="header-cart">
					<div class="cart-icon-count"><a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><svg viewBox="0 0 20 19" id="icon-cart"><title>gnc</title><path d="M18.153 10.982H7.044l.581 3.006 10.344.587-.07 1.22-.376-.023c.107.216.165.458.165.716 0 .92-.754 1.662-1.688 1.662-.93 0-1.684-.742-1.684-1.662 0-.326.096-.629.261-.883l-5.81-.333c.33.303.538.735.538 1.216 0 .92-.753 1.662-1.684 1.662-.93 0-1.688-.742-1.688-1.662 0-.55.273-1.038.692-1.337l-.269-.015L3 1.628H0V0h4.13l.577 1.97h15.288l-1.842 9.012z" fill-rule="evenodd"></path></svg> <span><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span></a>
					</div>
					<div class="cart-widget"><?php dynamic_sidebar( 'quick-cart' ); ?></div>
				</div>

<a class="btnfacebook" href="https://www.facebook.com/GNC.CR/" title="Facebook" rel="nofollow noopener" target="_blank">
	<span class="a2a_svg a2a_s__default a2a_s_facebook" style="background-color: rgb(59, 89, 152); width: 20px; line-height: 20px; height: 20px; background-size: 20px; border-radius: 3px;">
		<svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
			<path fill="#FFF" d="M17.78 27.5V17.008h3.522l.527-4.09h-4.05v-2.61c0-1.182.33-1.99 2.023-1.99h2.166V4.66c-.375-.05-1.66-.16-3.155-.16-3.123 0-5.26 1.905-5.26 5.405v3.016h-3.53v4.09h3.53V27.5h4.223z"></path>
		</svg>
	</span></a>

	</div>
			</div>
		</div>
		<nav id="site-navigation2" class="main-navigation2">

			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-main',
				'menu_id'        => 'main-menu',
			) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php
if (is_front_page() ) {
	putRevSlider("homeslide", "homepage");
}
	?>

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); ?>

	<div id="content" class="site-content">
		<div class="col-full">

		<?php
		/**
		 * Functions hooked in to storefront_content_top
		 *
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'storefront_content_top' );
