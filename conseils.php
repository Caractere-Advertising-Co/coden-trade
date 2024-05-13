<?php 
/* Template Name: Conseils */

get_header();

$title = get_field('titre');
$intro = get_field('introduction');
?>

<section id="introduction">
    <div class="container">
        <div class="colg">
            <?php if($title):
            echo $title;
        endif;?>
        </div>
        <div class="cold">
            <?php if($intro):
                echo $intro;
            endif;?>
        </div>
    </div>

    <div class="container">
        <div class="grid_articles">
            <?php 
            $args = array(
                'post_type' => 'post',
                'category__not_in' => 60,
                'posts_per_page'=> 9,
                'post_statut' => 'publish'
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
        </div>

        <div class="load-more-container">
            <a id="load-more-posts" class="cta" href="!#">Voir plus</a>
        </div>
    </div>
</section>



<?php get_template_part( 'templates-parts/section-catalogue' );?>
<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();