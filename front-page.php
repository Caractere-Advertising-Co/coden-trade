<?php get_header();?>

<?php get_template_part( 'templates-parts/header-nav');?>

<section id="hero-container">
    <div class="swiper">
        <div class="swiper-wrapper">
        <?php if(have_rows('slides')):
                while(have_rows('slides')) : the_row();?>
                    <?php $bg = get_sub_field('background_image');?>
                    <div class="swiper-slide">
                        <img src="<?php echo $bg['url'];?>" alt="bg_slider"/>
                        <div class="content">
                            <p class="baseline"><?php echo get_sub_field('sous-titre');?></p>
                            <h1><?php echo get_sub_field('titre');?></h1>
                            <a href="#" class="cta">test</a>
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
                    <?php $img = get_sub_field('background_service') ;?>
                    <div class="card" style="background:url(<?php echo $img['url'];?>) center;background-size:cover;">
                    </div>
                <?php endwhile;
            endif;?>
        </div>
    </div>
</section>




<?php get_footer();?>