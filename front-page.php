<?php get_header();?>

<?php get_template_part( 'templates-parts/header-nav');?>

<section id="hero-container">
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php if(have_rows('slides')):
                while(have_rows('slides')) : the_row();?>
            <?php $bg = get_sub_field('background_image');?>
            <div class="swiper-slide">
                <img src="<?php echo $bg['url'];?>" alt="bg_slider" />
                <div class="content">
                    <p class="baseline"><?php echo get_sub_field('sous-titre');?></p>
                    <?php echo get_sub_field('titre');?>
                    <a href="#" class="cta">NOS SOLUTIONS</a>
                </div>
            </div>
            <?php endwhile;
            endif;?>
        </div>

        <div class="swiper-button-prev swiper-button"></div>
        <div class="swiper-button-next swiper-button"></div>
    </div>
</section>

<section id="aboutus">
    <div class="container">
        <div class="grid">
            <?php if(have_rows('services')): 
                while(have_rows('services')): the_row();?>
            <?php 
            $img = get_sub_field('background_service');
            $link = get_sub_field('lien_service');?>

            <a href="<?php echo $link['url'];?>">
                <div class="card from-bottom"
                    style="background:url(<?php echo $img['url'];?>) center;background-size:cover;">
                    <h4><?php echo get_sub_field('nom_service');?></h4>
                </div>
            </a>
            <?php endwhile;
            endif;?>
        </div>

        <?php get_template_part( 'templates-parts/section-assurance' );?>
    </div>
</section>

<section id="mot_president">
    <div class="container">

        <?php get_template_part( 'templates-parts/section-nosproduits' );?>

        <div class="columns">
            <div class="col-g">
                <?php $img = get_field('image_nossolutions');?>
                <?php if($img):?>
                <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" class="from-left" />
                <?php endif;?>
            </div>
            <div class="col-d from-right">
                <?php echo get_field('texte_du_president');?>
            </div>
        </div>
    </div>

    <div class="separator"></div>
</section>

<section id="confiance">
    <div class="container">
        <?php echo get_field('titre_conf');?>
        <?php echo get_field('introduction_conf');?>

        <div class="table_qualite">
            <?php 
            if(have_rows('qualites')) :
                while(have_rows('qualites')): the_row();?>
            <div class="card_qualite">
                <?php 
                        $img = get_sub_field('icone');
                        $title = get_sub_field('titre');
                        $texte = get_sub_field('description');
                        ?>

                <?php if($img):?>
                <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" />
                <?php endif;?>
                <?php if($title):?>
                <h4><?php echo $title;?></h4>
                <?php endif;?>
                <?php if($texte):?>
                <p><?php echo $texte;?></p>
                <?php endif;?>
            </div>
            <?php endwhile;
            endif;?>
        </div>

        <?php $clink = get_field('cta_conf');?>
        <a href="<?php echo $clink['url'];?>" class="cta"><?php echo $clink['title'];?></a>
    </div>
</section>

<section id="disclaimer">
    <?php 
        $disbg = get_field('background');
        $title = get_field('titre_disclaimer');
        $disdesc = get_field('description_disclaimer');
        $linkdis = get_field('link_disclaimer');
    ?>

    <div class="container">
        <img src="<?php echo $disbg['url'];?>" />
        <div class="box-content">
            <?php echo $title;?>
            <?php echo $disdesc;?>
        </div>
    </div>
</section>

<section id="statistique">
    <div class="container">

        <div class="col-g">
            <?php $products = get_field('products');

            if(have_rows('produits_frontPage')):
                while(have_rows('produits_frontPage')) : the_row();
                    $icon = get_sub_field('icone_produits');
                    $txt = get_sub_field('texte_produits');

            ?>
            <div class="product_front"><?php
                    if($icon):?>
                <img src="<?php echo $icon['url'];?>" alt="<?php echo $icon['title'];?>" />
                <?php endif;
                
                ?><div class="txt"><?php
                echo $txt;?>
                </div>
            </div><?php

            endwhile;
            endif;?>

        </div>
        <div class="col-d">
            <?php 
            $imgStats = get_field('img_statistique');
            $descStats = get_field('description_stats');
            $dmdOffre = get_field('demandez_une_offre');
            $imgOffre = get_field('img_statistique');?>

            <div class="block_stats">

                <?php if($imgStats):?>
                <img src="<?php echo $imgStats['url'];?>" alt="<?php echo $imgStats['title'];?>" />
                <?php endif;?>

                <span>
                    <?php echo $descStats;?>
                </span>
            </div>

            <div class="getOffre">
                <?php echo $dmdOffre;?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('templates-parts/section-cta-contact');?>

<section id="disclaimer_banner">
    <?php 
    $bgBanner = get_field('arriere-plan_banner','options');
    $txtBanner = get_field('texte_banner','options');
    $imgBanner = get_field('image_banner','options');
    $ctaBanner = get_field('cta_banner','options');
    ?>

    <div class="container" style="background:url('<?php echo $bgBanner['url'];?>') no-repeat;background-size:cover;">
        <div class="colg">
            <?php echo $txtBanner;?>
        </div>
        <div class="cold">
            <img src="<?php echo $imgBanner['url'];?>" alt="<?php echo $imgBanner['title'];?>" />
            <a href="<?php echo $ctaBanner['url'];?>" class="cta bgBlue"><?php echo $ctaBanner['title'];?></a>
        </div>
    </div>
</section>

<section id="actualites">
    <div class="container">
        <div class="intro_actu">
            <?php echo get_field('titre_actus');?>
            <?php echo get_field('texte_actus');?>
        </div>
        <div class="grid_articles">
            <?php 
            $args = array(
                    'post_type' => 'post',
                    'posts_per_page'=> 2,
                    'post_statut' => 'publish'
            );

            $query = new WP_Query( $args );

            if($query->have_posts()):
                while($query->have_posts()): $query->the_post();?>
            <div class="card_article">
                <?php if ( has_post_thumbnail() ):?>
                <?php the_post_thumbnail();?>
                <?php endif;?>
                <h3><?php the_title();?></h3>

                <a href="<?php the_permalink();?>" class="red">Découvrir</a>
            </div><?php
                endwhile;
            endif;
            
            wp_reset_postdata();?>
        </div>
        <div class="view_more">
            <a href="#" class="cta bgBlue">Voir tout</a>
        </div>
    </div>
</section>


<?php get_template_part( 'templates-parts/contact' );?>


<?php get_footer();?>