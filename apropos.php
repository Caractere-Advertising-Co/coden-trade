<?php
/* Template Name: a-propos */

get_header();

$bg_header = get_field('bg_header');

if($bg_header):
    $bg_url = $bg_header['url'];
endif;

$titre = get_field('titre');
$intro = get_field('introduction');
$txtNaissance = get_field('txt_naissance');
$ctaNaiss = get_field('cta_naissance');

$titreService = get_field('titre_service');
$txtService = get_field('texte_service');
$galerie_ser = get_field('galerie_service');
$cta_ser = get_field('cta_service');
$bgService = get_field('background_service');
$img = get_field('img-separator');

$titrRefs = get_field('titre-refs');
$surRefs = get_field('surtitre-refs');
$ctaRefs = get_field('cta-refs');
?>


<?php get_template_part( 'templates-parts/popup-reference' );?>

<header id="header" <?php if($bg_header):?> style="background:url('<?php echo $bg_url;?>');"<?php endif;?>></header>

    
<section id="introduction">
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
</section>

<?php get_template_part( 'templates-parts/section-naissance' );?>

<section id="section-coprod">
    <?php get_template_part( 'templates-parts/section-nosproduits' );?>
</section>

<section id="service_particulier">
    <div class="container columns">
        <div class="colg">
            <?php if($titreService): echo $titreService; endif;?>
            <?php if($txtService): echo $txtService; endif;?>
            <?php if($cta_ser):?>
                <a href="<?php $cta_ser['url'];?>" class="cta"><?php $cta_ser['title'];?></a>
            <?php endif;?>
        </div>
        <div class="cold">
            <div class="swiper swiper-service">
                <div class="swiper-wrapper">
                    <?php if($galerie_ser): 
                        foreach($galerie_ser as $gal):?>
                            <div class="swiper-slide">
                                <img src="<?php echo $gal['url'];?>" alt="<?php $gal['title'];?>"/>
                            </div>
                        <?php endforeach;
                    endif;?>
                </div>
                <div class="swiper-button-prev swiper-prev-about"></div>
                <div class="swiper-button-next swiper-next-about"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php if($titreService): echo $titreService; endif;?>
    </div>

    <div class="service-bottom" <?php if($bgService):?>style="background:url('<?php echo $bgService['url'];?>')no-repeat;background-position: left center;"<?php endif;?>>
        <?php $i = 0;?>
        <div class="container">
            <div class="cold">
                <div class="col col-<?php echo $i;?>">                        
                    <?php
                        if(have_rows('liste_services')):
                            $count = count(get_field('liste_services'));

                            while(have_rows('liste_services')) : the_row();
                                $card = get_sub_field('carte');
                                $i++;
                                
                                if($card):?>
                                    <div class="card from-bottom">
                                        <?php echo $card;?>
                                    </div>
                                <?php endif;?>

                                    
                                <?php if($i == $count /2):?>
                                    </div><div class="col col-<?php echo $i;?>">
                                <?php endif;
                            endwhile;
                        endif;
                    ?>
                </div>
            </div>
        </div>

        <?php if($img):?>
            <div class="img-separator">
                <img src="<?php echo $img['url'];?>" alt="<?php echo $img['url'];?>"/>
            </div>
        <?php endif;?>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-experts' );?>

<section id="employes">
    <div class="container">
        <?php

        // 1. On définit les arguments pour définir ce que l'on souhaite récupérer
        $args = array(
            'post_type' => 'employe',
            'posts_per_page' => -1
        );

        // 2. On exécute la WP Query
        $employes = new WP_Query($args);
        $i = 0;

        // 3. On lance la boucle !
        if( $employes->have_posts() ) : 
            while( $employes->have_posts() ) : $employes->the_post();
                $nom = get_field('nom');
                $role = get_field('role');
                $contact = get_field('adresse_email');
                $bg = get_field('photo');
    
                $i++?>
                

                <div class="card <?php if($i % 3 == 2 ): echo '-center';endif;?> from-bottom" <?php if($bg):echo 'style="background:url('.$bg['url'].')";';endif;?>>
                    <div class="content-card">
                        <h4><?php echo $nom;?></h4>
                        <span class="ballSep"></span>
                        <p><?php echo $role;?></p>

                        <a href="mailto:<?php echo $contact;?>">Contact</a>
                    </div>    
                </div>
            <?php endwhile;
        endif;

        // 4. On réinitialise à la requête principale (important)
        wp_reset_postdata();
    ?>
    </div>
</section>

<section id="references">
    <div class="container">
        <h3><?php if($surRefs): echo $surRefs; endif;?></h3>
        <?php if($titrRefs): echo $titrRefs; endif;?>
        
        <?php get_template_part( 'templates-parts/btn-separator' );?>
    </div>

    <div class="container columns">
        <?php 
            $args = array(
                'post_type' => 'reference',
                'posts_per_page' => 3,
                'post_statut' => 'publish',
            );

            $query = new WP_Query($args);
            $i = 0;

            if($query->have_posts()):
                while($query->have_posts()): $query->the_post();
                    $i++;?>

                    <div class="<?php echo $i == 2 ? '-right' : '';?> from-bottom">
                        <a href="!#" data-index="<?php echo get_the_id();?>" class="type-reference">
                            <?php echo the_post_thumbnail();?>
                        </a>
                    </div>
                <?php endwhile;
            endif;

            wp_reset_postdata();
        ?>
    </div>

    <div class="container">
        <a href="<?php echo $ctaRefs['url'];?>" class="cta"><?php echo $ctaRefs['title'];?></a>
    </div>
</section>

<?php get_template_part( 'templates-parts/disclaimer-banner' );?>
<?php get_template_part( 'templates-parts/contact' );?>

<?php get_footer();