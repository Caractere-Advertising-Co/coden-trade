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

// Sous-catégories directes
$child_terms = get_terms([
    'taxonomy' => $taxonomy,
    'parent' => $current_term_id,
    'hide_empty' => true
]);

// Obtenir tous les IDs de la catégorie + enfants
$term_ids = [$current_term_id];
foreach ($child_terms as $child) {
    $term_ids[] = $child->term_id;
}

// Query des produits
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
        ],
    'orderby' => 'menu_order',
    'order'   => 'ASC'
];

$products = new WP_Query($args);
?>

<section id="introduction">
	<div class="container">
		<h1><?php echo $current_term->name;?></h1>
	</div>
</section>


<?php if ($parent_terms): ?>
<section id="list-subcategory">

    <div class="container grid">
        <?php foreach ($parent_terms as $term):
            $is_active = $term->term_id === $current_term->term_id || $term->term_id === $current_term->parent;
            ?>
            <a href="<?php echo get_term_link($term); ?>" data-term="<?php echo $term->term_id; ?>" class="elem-subcategory <?php echo $is_active ? 'active' : ''; ?>"><?php echo $term->name; ?></a>
        <?php endforeach; ?>
    </div>

    <div class="container columns resultSubitem">
        <button class="subItem active" data-filter="*">Tous</button>
        <?php foreach ($child_terms as $child): ?>
            <button class="subItem" data-filter=".term-<?php echo $child->term_id; ?>"><?php echo $child->name; ?></button>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- GRILLE PRODUITS -->

<div class="container table_product">
    <?php if ($products->have_posts()):
        while ($products->have_posts()) : $products->the_post();
            global $product;

            $term_classes = [];

            $terms = wp_get_post_terms(get_the_ID(), $taxonomy);
            foreach ($terms as $term) {
                $ancestors = get_ancestors($term->term_id, $taxonomy);
                $all_terms = array_merge([$term->term_id], $ancestors);
                foreach ($all_terms as $tid) {
                    $term_classes['term-' . $tid] = true;
                }
            }

            $tagClass = '';
            $tags = get_the_terms(get_the_ID(), 'product_tag');
            if ($tags) {
                foreach ($tags as $tag) {
                    if ($tag->name === 'Promo') $tagClass = '-white';
                    elseif ($tag->name === 'New') $tagClass = '-black';
                }
            }

            $class_string = 'card_product ' . implode(' ', array_keys($term_classes));
            ?>

            <li <?php wc_product_class($class_string, $product); ?>>
                <?php if ($tags): ?>
                    <div class="bubble <?php echo $tagClass; ?>">
                        <p><?php foreach ($tags as $t) echo $t->name . ' '; ?></p>
                    </div>
                <?php endif; ?>

                <?php do_action('woocommerce_before_shop_loop_item'); ?>
                <?php do_action('woocommerce_before_shop_loop_item_title'); ?>

                <div class="content-product">
                    <span class="title"><h3><?php the_title(); ?></h3></span>
                    <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
                    <?php do_action('woocommerce_after_shop_loop_item'); ?>
                </div>
            </li>
        <?php endwhile;
        wp_reset_postdata();
    else: ?>
        <p>Aucun produit trouvé.</p>
    <?php endif; ?>
</div>


<section id="citationTitle">
	<?php $title = get_field('cat_title','options'); ?>
    <div class="container"><?php if($title) echo $title; ?></div>
</section>

<?php
$queried_object = get_queried_object();
$bg_intro = get_field('background','term_'.$queried_object->term_id);
$intro = get_field('txt-intro','term_'.$queried_object->term_id);
$cta = get_field('cta','term_'.$queried_object->term_id);
?>

<section id="banner-intro">
    <div class="container">
        <?php if($intro) echo $intro; ?>
        <?php if($cta) echo '<a href="'.$cta['url'].'" class="cta">'.$cta['title'].'</a>'; ?>
    </div>
    <div class="block-img">
        <svg class="svg">
            <clipPath id="my-clip-path" clipPathUnits="objectBoundingBox">
                <path d="M0.579,1 H1 V0.003 H0.099 S-0.012,0.635,0.57,0.901"></path>
            </clipPath>
        </svg>
        <div class="clipped" style="background:url('<?php echo $bg_intro['url'];?>');"></div>
    </div>
</section>

<section id="nos_connaissances">
    <?php get_template_part( 'templates-parts/section-citation' ); ?>
</section>

<?php get_template_part( 'templates-parts/section-catalogue' ); ?>
<?php get_template_part( 'templates-parts/section-confiance' ); ?>

<?php get_footer( 'shop' ); ?>
