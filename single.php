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

<?php get_template_part( 'templates-parts/section-experts' );?>
<?php get_template_part( 'templates-parts/section-mots-president' );?>

<?php get_template_part( 'templates-parts/section-naissance' );?>

<section id="section_nosproduits">
    <div class="container from-bottom">
        <?php get_template_part( 'templates-parts/section-tableProduct' );?>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();