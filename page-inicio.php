<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

			endwhile; // End of the loop. ?>
			
			<div class="promo_boxes">
			
			
				<?php if( have_rows('promociones') ): ?>

					<div class="grid">

					<?php while( have_rows('promociones') ): the_row(); 

						// vars
						$image = get_sub_field('promoImagen');
						$content = get_sub_field('promoTexto');
						$link = get_sub_field('promolink');
						$btn = get_sub_field('promoBtn');

						?>

						<div class="grid__item one-half">
						
							<div class="promo_box" style="background-image: url('<?php echo $image['url']; ?>')">
								<?php echo $content; ?>
								<p class="promo_btn">
								<?php if( $link ): ?>
								<a href="<?php echo $link; ?>" class="btn button"><?php echo $btn; ?></a>
								<?php endif; ?></p>
							</div>
							

						</div>

					<?php endwhile; ?>

					</div>

				<?php endif; ?>
			
			
			
				<?php if( get_field('mostrar_titulo') != '1'){ ?>
						
						<style>.hentry.type-page .entry-header{display:none;}</style>
						
					<?php }  ?>
					
				
			</div>
			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
