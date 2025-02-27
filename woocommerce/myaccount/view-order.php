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
<h1 class="woocommerce-order-details__title"><?php esc_html_e( 'Order details', 'woocommerce' ); ?></h1>

</div>
<div class="container columns">
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
		?>
	</div>

	<div class="col-d download_documents">
		<a href="<?php echo do_shortcode('[wcpdf_document_link]');?>" action="print()">Imprimer ma facture</a>
		<?php echo do_shortcode( "[wcpdf_download_pdf]" );	?>
	</div>
</div>

<section id="content-order" class="details_admin_order">
	<div class="container columns">
		<div class="col col-1">
			<h2>Mode de livraison</h2>
			
			<p><?php echo $order->get_shipping_method();?></br>
			Prévue le : <?php echo wc_format_datetime( $order->get_date_created(), "d F Y" );?></p>
		</div>
		<div class="col col-2">
			<h2>Mode de facturation</h2>

			<p><?php echo $order->get_payment_method_title();?></p>
		</div>
		<div class="col col-3">
			<h2>Adresse de facturation</h2>
			<p>
				<?php echo 
					$order->get_billing_last_name() . ' ' . $order->get_billing_first_name() . '</br>'.			   
				    $order->get_billing_company() .
					$order->get_billing_address_1() .
			  	    $order->get_billing_address_2() . '</br>' .
					$order->get_billing_city() . ' ' . $order->get_billing_postcode() . '</br>'.
			 		$order->get_billing_country() . '</br>'.
					$order->get_billing_phone();?>
			</p>	
		</div>
	</div>
</section>

<section id="resume_order_details">
	<div class="container columns">
		<div class="colg">
			<h2>Articles</h2>

			<?php 
		foreach ( $order->get_items() as $item_id => $item ) {
			$product_name = $item->get_name();
			$allmeta = $item->get_meta_data();

			$quantity = $item->get_quantity();

			echo '<div class="card_product">';
			echo '<h3>' . $product_name . '<span> x ' . $quantity.'</span></h3>';

			foreach ($allmeta as $meta ):
				echo '<p>'. ucfirst($meta->key).' '. $meta->value.'</p>';
			endforeach;

			echo '</div>';
			
		 }?>
		</div>

		<div class="colg">
			<h2>Résumé</h2>

			<?php 

			$labelNumber = $orderColumns['order-number'];
			$labelStatus = $orderColumns['order-status'];
			$labelTotal = $orderColumns['order-total'];
			$total = $order->get_total();
			$tva = $order->get_total_tax();
			$subtotal = $order->get_subtotal_to_display();
			$livraison = $order->get_shipping_total();

			echo '<p>'.$labelDate. ' : '. wc_format_datetime( $order->get_date_created(), "d F Y" ).'</p>';
			echo '<p>'.$labelStatus.' : '.  $order->get_status() .'</p>';
	 		echo '<p>'.$labelNumber.' : '. $order->get_id(). '</p>';

			echo '<div class="total">';

			echo '<p>Total produit : '. $subtotal . ' €</p>';
			echo '<p>Livraison : '. $livraison . ' €</p>';
			echo '<p> TVA(21%) : '. $tva . '€</p>';
		 	echo '<p> Total produit : '. $total . '€</p>';

			echo '</div>';
			?>

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

<?php //do_action( 'woocommerce_view_order', $order_id ); ?>
