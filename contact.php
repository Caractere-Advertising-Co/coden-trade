<?php 
/* Template Name: contact */

get_header();

$surtitre = get_field('surtitre');
$titre = get_field('titre');
$intro = get_field('intro');
$form = get_field('formulaire');
$contact = get_field('contact');
$surModif = get_field('surtitre_modif');
$text_modif = get_field('text_modif');
$bg_header = get_field('background');?>

<section id="hero">
    <?php if($bg_header):?><img src="<?php echo $bg_header['url'];?>"><?php endif;?>
</section>

<?php get_template_part( 'templates-parts/contact' );?>

<section id="nos_connaissances">
    <div class="container top_content">
        <?php get_template_part( 'templates-parts/section-citation' );?>
    </div>
</section>
<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();