<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);

$imgUrl = array();

$gallery_images = $product->get_gallery_image_ids();

foreach($gallery_images as $images): 
	array_push($imgUrl, wp_get_attachment_image_src($images, 'Large'));
endforeach;

?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="woocommerce-product-gallery__wrapper">
		<?php
		if ( $gallery_images ) {
			?>
			<div class="swiper swiper-product">
			<div class="swiper-wrapper">
				<?php foreach($imgUrl as $img):?>

					<div class="swiper-slide">
						<img src="<?php echo $img[0];?>">
					</div>
				<?php endforeach;?>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>

		<div class="swiper swiper-thumbs">
			<div class="swiper-wrapper">
				<?php foreach($imgUrl as $img):?>

					<div class="swiper-slide">
						<img src="<?php echo $img[0];?>">
					</div>
				<?php endforeach;?>
			</div>
		</div><?php 
		} else {
			echo wc_get_gallery_image_html( $post_thumbnail_id, true );
		}
		?>
	</div>
	
</div>
