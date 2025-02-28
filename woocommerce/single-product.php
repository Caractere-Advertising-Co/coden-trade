<?php
/**
 * The Template for displaying all single products
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 


global $product;

$banner = array();
$thmb_images = $product->get_image_id();

array_push($banner, wp_get_attachment_image_src($thmb_images, 'Large'));

	if($banner):?>
		<div class="banner" id="hero">
			<img src="<?php echo $banner[0][0];?>" style="background-size:cover;background-repeat:no-repeat;"/>
		</div>
	<?php endif;
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>	
	<section id="content_product">
		<div class="container">
			<?php while ( have_posts() ) :the_post(); ?>
				<?php wc_get_template_part( 'content', 'single-product' ); ?>
			<?php endwhile; // end of the loop. ?>
		</div>
	</section>
	<?php do_action( 'woocommerce_after_main_content' );?>

<section id="particuliers">
	<div class="container columns">
		<?php 
			$txtService = get_field('description-service');
			$imgService = get_field('image-service');
			$ctaService = get_field('cta-service');
		?>
		<div class="col-g">
			<?php if($imgService): ?>
				<div class="block-img">
					<img src="<?php echo $imgService['url'];?>" alt="<?php echo $imgService['title'];?>"/>
				</div>
			<?php endif;?>
		</div>

		<div class="col-d">
			<?php if($txtService): echo $txtService;endif;?>
			<?php if($ctaService):?>
				<a href="<?php echo $ctaService['url'];?>" class="cta"><?php echo $ctaService['title'];?></a>
			<?php endif;?>
		</div>
	</div>
</section>

<?php get_template_part( 'templates-parts/section-nosproduits' );?>
<?php get_template_part( 'templates-parts/section-catalogue' );?>

<section id="nos_connaissances">
    <div class="container top_content">
        <?php get_template_part( 'templates-parts/section-citation' );?>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
