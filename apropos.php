<?php
/* Template Name: a-propos */

get_header();

$bg_header = get_field('bg_header');

if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url = $bg_header['url'];
endif;


$titre = get_field('titre');
$intro = get_field('introduction');
$txtNaissance = get_field('txt_naissance');
$ctaNaiss = get_field('cta_naissance');

$titrRefs = get_field('titre-refs');
$surRefs = get_field('surtitre-refs');
$ctaRefs = get_field('cta-refs');
?>

<?php get_template_part( 'templates-parts/popup-reference' );?>

<div id="header" <?php if($bg_header):?> style="background:url('<?php echo $bg_url;?>');"<?php endif;?>></div>

    
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

<?php get_template_part( 'templates-parts/section-serviceparticulier' );?>
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

                    <div class="<?php echo $i == 2 ? '-right' : '' ;?> from-bottom">
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