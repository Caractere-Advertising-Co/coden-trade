<?php 
/* Template Name: page article */

get_header();

$subtitle = get_field('subtitle-sm');
$titre = get_field('titre');
$intro = get_field('texte_introduction');
$section_bleue = get_field('section_bleue');
$textCta = get_field('texte_cta');
$cta = get_field('cta');
$outro = get_field('outro');
$img = get_field('image-separator');

/* Section black */

$secondTitre = get_field('titre-expert');
$secondText = get_field('texte-expert');
$secondCTA = get_field('cta-expert');

$args = array(
    'titre_second_para' => $secondTitre,
    'texte_second_para' => $secondText,
    'cta_second_para' => $secondCTA 
);

/* Section black */

$tirthTitre = get_field('titre-fournisseur');
$tirthText = get_field('texte-fournisseur');
$tirthCTA = get_field('cta-fournisseur');
$tirthGalerie = get_field('galerie_fournisseur');

$args_2 = array(
    'titre_tirth_para' => $tirthTitre,
    'texte_tirth_para' => $tirthText,
    'galerie_tirth_para' => $tirthGalerie,
    'cta_tirth_para' => $tirthCTA 
);

$gridProduct = get_field('display_grid_product');

?>

<section id="simple-page">
    <div class="container">
        <div class="colg">
            <div class="intro from-bottom">
                <?php if($titre) : echo $titre;endif;?>
            </div>
        </div>
        <div class="cold">
            <div class="intro from-bottom"><?php if($intro) : echo $intro;endif;?></div>
        </div>
    </div>

    <?php if($img):?>
            <div class="img-separator">
                <img src="<?php echo $img['url'];?>" alt="<?php echo $img['url'];?>"/>
            </div>
        <?php endif;?>
</section>

<?php get_template_part( 'templates-parts/section-experts', null, $args );?>
<?php get_template_part( 'templates-parts/section-serviceparticulier', null , $args_2 );?>

<?php get_template_part( 'templates-parts/section-naissance' );?>

<?php if($gridProduct):?>
    <section id="section_nosproduits">
        <div class="container from-bottom">
            <?php get_template_part( 'templates-parts/section-tableProduct' );?>
        </div>
    </section>
<?php endif;?>

<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();