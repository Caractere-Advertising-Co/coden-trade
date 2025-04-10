<?php
defined('ABSPATH') || exit;

get_header('shop');

$taxonomy = 'product_cat';
$current_term_id = get_queried_object_id();
$current_term = get_term($current_term_id, $taxonomy);

// Récupère les 4 catégories parents (niveau 0)
$parent_terms = get_terms([
    'taxonomy' => $taxonomy,
    'parent' => 0,
    'hide_empty' => true
]);

// Sous-catégories de la catégorie active
$child_terms = get_terms([
    'taxonomy' => $taxonomy,
    'parent' => $current_term_id,
    'hide_empty' => true	
]);

// Obtenir tous les IDs : catégorie active + ses enfants
$term_ids = [$current_term_id];
foreach ($child_terms as $child) {
    $term_ids[] = $child->term_id;
}

// Query produits (catégorie + enfants)
$args = [
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => [
        [
            'taxonomy' => $taxonomy,
            'field' => 'term_id',
            'terms' => $term_ids,
            'include_children' => true,
        ]
    ]
];

$products = new WP_Query($args);
?>

<?php if (!empty($child_terms)) : ?>
   
<?php endif; 

if($parent_terms):?>
	<section id="list-subcategory">
		<?php $title = get_field('cat_title','options');?>

		<div class="container"><?php if($title): echo $title;endif; ?></div>
		
		<div class="container grid">
			<?php

			// Loop through product subcategories WP_Term Objects
			foreach ( $parent_terms as $term ):

				$is_active = $term->term_id === $current_term->term_id || $term->term_id === $current_term->parent;

				$term_link = get_term_link( $term, $taxonomy );

				$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id );?>
				
				<a href="<?php echo get_term_link($term);?>" data-term="<?php echo $term->term_id;?>" class="elem-subcategory <?php echo $is_active ? ' active' : ''; ?>"><?php echo $term->name;?></p></a>
			<?php endforeach;?>
		</div>


		<div class="container columns resultSubitem">
			<button class="subItem active" data-filter="*">Tous</button>

			<?php foreach ($child_terms as$child):?>
				<button class="subItem"  data-filter=".term-<?php echo $child->term_id; ?>"><?php echo $child->name;?></button>
			<?php endforeach;?>
		</div>
	</section>
<?php endif;?>

<!-- GRILLE PRODUITS -->

<div class="container table_product">
    <?php if ($products->have_posts()) :
        while ($products->have_posts()) : $products->the_post();
            global $product;

            $term_classes = '';
            $terms = wp_get_post_terms(get_the_ID(), $taxonomy);
            foreach ($terms as $term) {
                $term_classes .= ' term-' . $term->term_id;
            }

			$pid = get_the_id();
			$price = get_post_meta( get_the_ID(), '_price', true);
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

            ?>

			<?php $newClass= 'card_product ' . $term_classes;?>
			<li <?php wc_product_class( $newClass , $product );?>>

	<?php if($tags): ?>
		<div class="bubble <?php echo $tagClass;?>">
			<p><?php foreach($tags as $t): echo $t->name; endforeach;?></p>
		</div>
	<?php endif;
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );
	
	?>

	<div class="content-product">
	<?php 
	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */

	 echo '<span class="title"><h3>'. get_the_title($pid).'</h3></span>';

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
	</div>
</li>

        <?php endwhile;
        wp_reset_postdata();
    else : ?>
        <p>Aucun produit trouvé.</p>
    <?php endif; ?>
</div>

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

<section id="nos_connaissances">
	<?php get_template_part( 'templates-parts/section-citation' );?>
</section>

<?php get_template_part( 'templates-parts/section-catalogue' );?>
<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer( 'shop' );