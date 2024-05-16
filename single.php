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

<section id="section_nosproduits">
    <div class="container from-bottom">
        <?php 
            $currentId = get_the_ID();
            $args = array(
                'post_type' => 'post',
                'posts_per_page'=> 3,
                'post_statut' => 'publish',
                'post__not_in' => $currentId,
            );

            $query = new WP_Query( $args );

            if($query->have_posts()):
                while($query->have_posts()): $query->the_post();?>
            
                <div class="card_article from-bottom">
                    <a href="<?php the_permalink();?>" class="red">
                        <div class="miniature">
                            <img src="<?php if(has_post_thumbnail()) : the_post_thumbnail_url(); endif;?>"/>
                        </div>

                        <h4><?php the_date();?></h4>
                        <h3><?php the_title();?></h3>

                        <a href="">Découvrir</a>
                    </a>
                </div>
            <?php
                endwhile;
            endif;
            
            wp_reset_postdata();?>
        ?>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();