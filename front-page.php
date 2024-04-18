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

<?php get_template_part( 'templates-parts/' );?>

<section id="section_nosproduits">
    <div class="container">
        <?php get_template_part( 'templates-parts/section-nosproduits' );?>

        <div class="from-bottom">
            <?php get_template_part( 'templates-parts/section-tableProduct' );?>
        </div>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-bannerfullwidth-dark' );?>
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

<?php get_template_part( 'templates-parts/disclaimer-banner' );?>
<?php get_template_part( 'templates-parts/section-cta-contact' );?>

<section id="nos_connaissances">
    <?php get_template_part( 'templates-parts/section-citation' );?>
</section>

<section id="prix-compétitifs">
    <?php 
        $texte = get_field('txt_hyper');
        $cta = get_field('cta_hyper');
        $img = get_field('img_hyper');
    ?>
    <div class="container columns">
        <div class="col-g">
            <?php if($img):?><img src="<?php echo $img['url'];?>" alt="<?php echo $img['title'];?>"/><?php endif;?>
        </div>

        <div class="col-d">
            <?php if($texte): echo $texte; endif;?>
            <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta bgBlue">'.$cta['title'].'</a>'; endif;?>
        </div>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-confiance' );?>

<section id="actualites">
    <div class="container">
        <div class="intro_actu">
            
            <?php 
            $titre = get_field('titre_actus');
            $texte = get_field('texte_actus');
            $cta = get_field('cta_actus');
            ?>
            
            <?php if($titre):?><span class="from-left"><?php echo $titre;?></span><?php endif;?>
            <?php if($texte):?><span class="from-left"><?php echo $texte?></span><?php endif;?>
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
            <a href="<?php echo $cta['url'];?>" class="cta from-bottom"><?php echo $cta['title'];?></a>
        </div>
    </div>
</section>

<?php get_template_part( 'templates-parts/contact' );?>

<?php get_footer();?>