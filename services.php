<?php
/* Template Name: Services */

get_header();
$bg_header = get_field('background');
$title_header = get_field('titre_page');
$linkf = get_field('link_to_form');?>

<?php get_template_part( 'templates-parts/header-nav');?>


<header id="header" style="background:url('<?php echo $bg_header['url'];?>');">
</header>

<section id="intro_service">
    <div class="container">
        <div class="block_title"
            style="background:url('<?php echo get_template_directory_uri();?>/assets/img/background_titre_service.jpg;">
            <?php echo $title_header;?>
            <a href="<?php echo $linkf['url'];?>"><?php echo $linkf['title'];?></a>
        </div>
        <?php
            $title_page = get_field('titre_service');
            $content_intro = get_field('introduction');
        ?>
        <div class="colg">
            <?php echo $title_page;?>
        </div>

        <div class="cold">
            <?php echo $content_intro;?>
        </div>
    </div>
</section>

<section id="nos_points_fort">
    <div class="container">
        <?php get_template_part( 'templates-parts/section-pointsfort' );?>
        <?php get_template_part( 'templates-parts/section-cta-contact' );?>
        <?php get_template_part( 'templates-parts/section-nosproduits' );?>
    </div>
</section>

<section id="assurance">
    <div class="container">
        <?php get_template_part( 'templates-parts/section-assurance' );?>
    </div>
</section>

<section id="contact-service">
    <?php get_template_part( 'templates-parts/contact' );?>
</section>
<?php get_footer();