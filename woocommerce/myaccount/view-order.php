<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();
?>
<div class="container">
<h2 class="woocommerce-order-details__title"><?php esc_html_e( 'Order details', 'woocommerce' ); ?></h2>

</div>
<div class="container columns">
	<div class="col-g">
		<?php	
			$orderColumns = wc_get_account_orders_columns();
			$labelDate = $orderColumns['order-date'];
			$labelNumber = $orderColumns['order-number'];
			$labelStatus = $orderColumns['order-status'];
			$labelTotal = $orderColumns['order-total'];

			echo '<p>'.$labelDate. ' : '. wc_format_datetime( $order->get_date_created(), "d F Y" ).'</p>';
			echo '<p>'.$labelStatus.' : '.  $order->get_status() .'</p>';
			echo '<p>'.$labelNumber.' n° : '.$order->get_order_number().'</p>';
			echo '<p>'.$labelTotal.' de la commande :' . $order->get_formatted_order_total().'</p>';
		?>
	</div>

	<div class="col-d">
		<a href="<?php echo do_shortcode('[wcpdf_document_link]');?>" action="print()">Imprimer ma facture</a><br>
		<?php echo do_shortcode( "[wcpdf_download_pdf]" );	?>
	</div>
</div>

<section id="content-order">
	<div class="container columns">
		<div class="col col-1">
			<h2>Mode de livraison</h2>
			
			<p><?php echo $order->get_shipping_method();?></br>
			Prévue le : <?php echo $order->get_date_created();?></p>

		</div>
		<div class="col col-2">
			<h2>Mode de facturation</h2>

			<p><?php echo $order->get_payment_method_title();?></p>
		</div>
		<div class="col col-3">
			<h2>Adresse de facturation</h2>
			<p>
				<?php echo $order->get_billing_last_name() . ' ' . $order->get_billing_first_name() . '</br>'.
						   
						   $order->get_billing_company() . '</br>'.
						   $order->get_billing_address_1() . '</br>'.
						   $order->get_billing_address_2() . '</br>'.
					       $order->get_billing_city() . ' ' . $order->get_billing_postcode() . '</br>'.
						   $order->get_billing_country() . '</br>'.
						   $order->get_billing_phone();?>
			</p>	
		</div>
	</div>
</section>


<?php if ( $notes ) : ?>
	<h2><?php esc_html_e( 'Order updates', 'woocommerce' ); ?></h2>

	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="woocommerce-OrderUpdate comment note">
			<div class="woocommerce-OrderUpdate-inner comment_container">
				<div class="woocommerce-OrderUpdate-text comment-text">
					<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( esc_html__( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<div class="woocommerce-OrderUpdate-description description">
						<?php echo wpautop( wptexturize( $note->comment_content ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>

<?php do_action( 'woocommerce_view_order', $order_id ); ?>
