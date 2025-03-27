<?php 
/* Template Name: page blog */

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
            $total_posts = wp_count_posts('post')->publish; // Nombre total d'articles publiés
            $posts_per_page = 9;


            $args = array(
                    'post_type' => 'post',
                    'posts_per_page'=> $posts_per_page,
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

                        <a href="<?php the_permalink();?>">Découvrir</a>
                    </a>
                </div>
            <?php
                endwhile;
            endif;
            
            wp_reset_postdata();?>
        </div>

        <?php if ($total_posts > $posts_per_page): ?>
            <div class="load-more-container">
                <a id="load-more-posts" class="cta" href="!#">Voir plus</a>
            </div>
        <?php endif; ?>
    </div>
</section>



<?php get_template_part( 'templates-parts/section-catalogue' );?>
<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();