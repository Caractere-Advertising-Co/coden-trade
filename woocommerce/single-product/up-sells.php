<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( $upsells ) : ?>

	<section class="up-sells upsells products">
		<?php
		$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $upsells as $upsell ) :

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					$pid = $upsell->id;
					$cat = get_the_terms( $pid, 'product_cat' );
					$tags = get_the_terms( $pid, 'product_tag' );

					if($tags):
						foreach($tags as $t):
							switch($t->name){
								case 'Promo':
									$tagClass = '-white';
									break;
								case 'New':
									$tagClass = '-black';
									break;
								default:
									$tagClass = '';
									break;
							}
						endforeach;
					endif;

					// Ensure visibility.
					if ( empty( $upsell ) || ! $upsell->is_visible() ) {
						return;
					}

					?>
									
					<li <?php wc_product_class( 'card_product', $upsell ); ?>>
						<a href="<?php echo get_permalink($pid);?>">

						<?php if($tags): ?>
							<div class="bubble <?php echo $tagClass;?>">
								<p><?php foreach($tags as $t): echo $t->name; endforeach;?></p>
							</div>
						<?php endif; 
	
						$thmb_images = $upsell->get_image_id();
						$thmb = wp_get_attachment_image( $thmb_images, 'Large' );?>
			
						<div class="block-img">
							<img src="<?php echo $thmb;?>" style="background-size:cover;background-repeat:no-repeat;"/>
						</div>

						<div class="content-product">
							<?php echo '<span class="title"><h3>'. get_the_title($pid).'</h3></span>';

							do_action( 'woocommerce_after_shop_loop_item_title' );
							do_action( 'woocommerce_after_shop_loop_item' ); ?>
						</div>
					</a>
				</li>
			<?php endforeach; ?>
		<?php woocommerce_product_loop_end(); ?>
	</section>

	<?php
endif;

wp_reset_postdata();