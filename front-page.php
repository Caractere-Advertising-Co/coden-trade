<?php get_header();?>

<section id="hero-container">
    <div class="swiper swiper-hero">
        <div class="swiper-wrapper">
            <?php if(have_rows('slides')):
                while(have_rows('slides')) : the_row();?>
                    <?php $bg = get_sub_field('background_image');?>
                    <?php $cta = get_sub_field('liens');?>

                    <?php if($bg):?>
                    <div class="swiper-slide">
                        <img src="<?php echo $bg['url'];?>" alt="bg_slider" />
                        <div class="content">
                            <p class="baseline"><?php echo get_sub_field('sous-titre');?></p>
                            <?php echo get_sub_field('titre');?>
                            <a href="<?php echo $cta['url'];?>" class="cta">NOS PRODUITS</a>
                        </div>
                    </div>
                    <?php endif;
                endwhile;
            endif;?>
        </div>

        <div class="swiper-pagination"></div>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-card-services' );?>

<section id="section_nosproduits">
    <div class="container">
        <?php get_template_part( 'templates-parts/section-nosproduits' );?>

        <div class="from-bottom">
            <?php get_template_part( 'templates-parts/section-tableProduct' );?>
        </div>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-mots-president' );?>

<section id="big_categories">
    <div class="container">
        <div class="colg">
            <?php $categories = get_field('categories','options');?>

            <ul>
                <li class="outline active" id="cat-1">Clotures</li>
                <li class="outline" id="cat-2">Accès</li>
                <li class="outline" id="cat-3">Couverture</li>
                <li class="outline" id="cat-4">Panneaux</li>
                <li class="outline" id="cat-5">Autres</li>
            </ul>
            
        </div>

        <div class="cold">
            <ul class="panel panel1">
                <li>Cloture rigides</li>
                <li>Cloture souples</li>
                <li>Cloture en bois</li>
                <li>Cloture en composite</li>
                <li>Cloture en béton</li>
                <li>Cloture pour clotures</li>
                <li>Accessoires</li>
                <li>Brise vue / occultation</li>
                <li>Palissades</li>
                <li>Gabions</li>
            </ul>
            <ul class="panel panel2">
                <li>Acces</li>
                <li>Acces</li>
            </ul>

            <a href="#" class="cta">Découvrir</a>
        </div>
    </div>
</section>

<?php get_template_part('templates-parts/disclaimer-banner');?>
<?php get_template_part('templates-parts/section-cta-contact');?>

<section id="nos_connaissances">
    <div class="container top_content">
        <?php
            $imgCons = get_field('image_cons');
            $cold_cons = get_field('texte-col-con');
            $cta_cons = get_field('cta_cons');
        ?>

        <?php get_template_part( 'templates-parts/section-citation' );?>

        </div>
        <div class="container columns">
            <div class="colg">
                <?php if($imgCons):?><img src="<?php echo $imgCons['url'];?>" alt="<?php echo $imgCons['title'];?>"/><?php endif;?>
            </div>
            <div class="cold">
                <?php if($cold_cons): echo $cold_cons; endif;?>
                <?php if($cta_cons):?> 
                    <a href="<?php echo $cta_cons['url'];?>" class="cta bgBlue"><?php echo $cta_cons['title'];?></a>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-confiance' );?>

<section id="actualites">
    <div class="container">
        <div class="intro_actu">
            <span class="from-left"><?php echo get_field('titre_actus');?></span>
            <span class="from-left"><?php echo get_field('texte_actus');?></span>
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
            
            <a href="<?php the_permalink();?>" >
            <div class="card_article from-bottom">
                <?php if ( has_post_thumbnail() ):?>
                    <div class="home-thumbnail">
                        <?php the_post_thumbnail();?>
                    </div>
                <?php endif;?>
                <div class="metaData"><p><?php the_category(' ');?><span class="puntSep">•</span><?php echo the_date('d F Y');?></p></div>
                <h3><?php the_title();?></h3>

               
            </div></a><?php
                endwhile;
            endif;
            
            wp_reset_postdata();?>
        </div>
        <div class="view_more">
            <a href="#" class="cta from-bottom">TOUT VOIR</a>
        </div>
    </div>
</section>

<?php get_template_part( 'templates-parts/contact' );?>

<?php get_footer();?>