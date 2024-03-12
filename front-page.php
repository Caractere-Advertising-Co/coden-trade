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

<?php get_template_part( 'tempaltes-parts/section-bannerfullwidth' );?>
<?php get_template_part( 'templates-parts/section-mots-president' );?>

<section id="big_categories">
    <div class="container">
        <?php $parent_categories = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false, 'parent' => 0]); 
        
        if ($parent_categories): ?>
            <div class="colg">
                <ul>
                    <?php $i = 0;
                    foreach ($parent_categories as $parent_cat):?>
                        <li class="outline <?php echo $i == 0 ? 'active' : '';?>" id="cat-<?php echo $i;?>"><?php echo $parent_cat->name;?></li>
                        <?php $i++;
                    endforeach; ?>
                </ul>
            </div>

            <div class="cold">
                <?php
                $i = 0; 
                foreach ($parent_categories as $parent_cat):
                    $child_categories = get_term_children($parent_cat->term_id, 'product_cat');
                    if (!empty($child_categories)) {
                        echo '<ul class="panel panel' . $i . '">';
                        foreach ($child_categories as $child_id):
                            $child_cat = get_term_by('id', $child_id, 'product_cat');
                            echo '<li><a href="' . get_term_link($child_cat) . '">' . $child_cat->name . '</a></li>';
                        endforeach;
                        echo '</ul>';
                    }
                    $i++;
                endforeach;?>
                <a href="#" class="cta">Découvrir</a>
            </div>
        <?php endif;?> 
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