<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) :

	foreach ( $customer_orders->orders as $customer_order ) {
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>

		<div class="order-resume columns">
			<div class="col-g">
				<?php
				
				$orderColumns = wc_get_account_orders_columns();
				$labelDate = $orderColumns['order-date'];
				$labelNumber = $orderColumns['order-number'];
				$labelStatus = $orderColumns['order-status'];
				$labelTotal = $orderColumns['order-total'];

				$statusOrder = $order->get_status();

				switch($statusOrder){
					case 'processing': 
						$valStatut = '<span class="badge on-hold">En cours</span>';
						break;
					
					case 'completed':
						$valStatut = '<span class="badge completed">Terminée</span>';
						break;

					case 'cancelled':
						$valStatut = '<span class="badge cancelled">Terminée</span>';
						break;
				}

				echo '<p>'.$labelDate. ' : '. wc_format_datetime( $order->get_date_created(), "d F Y" ).'</p>';
				echo '<p>'.$labelStatus.' : '.  $valStatut .'</p>';
				echo '<p>'.$labelNumber.' n° : '.$order->get_order_number().'</p>';
				echo '<p>'.$labelTotal.' de la commande :' . $order->get_formatted_order_total().'</p>';
				$actions = wc_get_account_orders_actions( $order );

				if ( ! empty( $actions ) ) {
					foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

						echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button' . esc_attr( $wp_button_class ) . ' button ' . sanitize_html_class( $key ) . '">'.$action['name'].'</a>';
					}
				}
				?>
			</div>

			<div class="col-d">
				<?php 
					$items = $order->get_items();

					foreach ($items as $item):
					
						$product_description = get_post($item['product_id'])->post_content;?>

						<div class="order-product">
							<h3><?php echo $item['name'];?></h3>
							<p><?php echo $product_description;?></p>

							<?php $meta = $item->get_meta_data();

							if($meta):?>
								<div class="meta-data">
									<?php foreach($meta as $metadata):
										$attribute = $metadata->get_data();

										$value = $attribute['value'];
										$label = $attribute['key'];
										
										switch ($label){
											case 'pa_couleur':
												$name = 'Couleurs standards';
												break;
											case 'pa_diametre-fil':
												$name = 'Epaisseur';
												break;

											default:
												$name = $key;
												break;
										}?>
									<p><?php if($name): echo $name . ' ' . $value; endif;?>  </p>
									<?php endforeach;?>
								</div>
							<?php endif;?>
						</div>
					<?php endforeach;?>
			</div>
		</div>
	<?php }?>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button<?php echo esc_attr( $wp_button_class ); ?>" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button<?php echo esc_attr( $wp_button_class ); ?>" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>

	<?php wc_print_notice( esc_html__( 'No order has been made yet.', 'woocommerce' ) . ' <a class="woocommerce-Button wc-forward button' . esc_attr( $wp_button_class ) . '" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">' . esc_html__( 'Browse products', 'woocommerce' ) . '</a>', 'notice' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
