<?php 
/* Template Name: références */


$title = get_field('titre');
$intro = get_field('introduction');

get_header();?>

<?php get_template_part( 'templates-parts/popup-reference' );?>

<section id="introduction-ref">
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
</section>

<section id="references">
    <div class="container">
        <div class="grid-references">
            <?php 
                $references = new WP_Query(array(
                    'post_type' => 'reference',
                    'posts_per_page' => 9,
                    'paged' => 1,
                ));


                if ($references->have_posts()):
                    while ($references->have_posts()): $references->the_post(); ?>
                        <?php 
                            $intro = get_field('description_projet');
                            $lieu = get_field('lieu_du_projet');
                            $galerie = get_field('galerie');

                            if($galerie):
                                $thumbnails = $galerie[0]['url'];
                            endif;
                        ?>
                        
                        <a href="<?php echo get_permalink();?>" data-index="<?php echo get_the_id();?>" style="background:url('<?php echo $thumbnails;?>');" <?php echo post_class( );?>>
                            <div class="card-projet">
                                <div class="text">
                                    <h3><?php the_title();?></h3>
                                    <p><?php if($lieu): echo 'À '.$lieu;endif;?></p>
                                </div>
                                <span class="plus">+</span>
                            </div>
                        </a>
                    <?php endwhile;
                endif;
                
                wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-catalogue' );?>
<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();