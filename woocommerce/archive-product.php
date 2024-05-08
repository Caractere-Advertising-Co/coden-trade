<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

?>

<?php
	$queried_object = get_queried_object();
	$bg_intro = get_field('background','term_'.$queried_object->term_id);
	$intro = get_field('txt-intro','term_'.$queried_object->term_id);
	$cta = get_field('cta','term_'.$queried_object->term_id);
?>

<section id="banner-intro" >
	<div class="container">
		<?php if($intro): echo $intro; endif;?>
		<?php if($cta): echo '<a href="'.$cta['url'].'" class="cta">'.$cta['title'].'</a>'; endif;?>
	</div>
	<div class="block-img" >
		<svg class="svg">
			<clipPath id="my-clip-path" clipPathUnits="objectBoundingBox">
				<path d="M0.579,1 H1 V0.003 H0.099 S-0.012,0.635,0.57,0.901"></path>
			</clipPath>
		</svg>

		<div class="clipped" style="background:url('<?php echo $bg_intro['url'];?>');"></div>
	</div>
</section>

<section id="list-subcategory">
	<?php 
		$term_id  = get_queried_object_id();
		$taxonomy = 'product_cat';
	
		// Get subcategories of the current category
		$terms    = get_terms([
			'taxonomy'    => $taxonomy,
			'hide_empty'  => false,
			'parent'      => $term_id 
		]);
	?>

	<div class="container grid">
		<?php

		// Loop through product subcategories WP_Term Objects
		foreach ( $terms as $term ):

			$term_link = get_term_link( $term, $taxonomy );

			$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );?>
			
			<a href="<?php echo $term_link;?>" class="elem-subcategory">
				<div class="thumbnails-subcat">
					<img src="<?php echo $image;?>" alt="miniatures"/>
				</div>

				<p><?php echo $term->name;?></p>
			
			</a>
		<?php endforeach;
		?>
	</div>
</section>

<?php

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );


?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>



<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
