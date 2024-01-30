<?php 
/* Template Name: Nos-solutions */ 

get_header();
$bg_header = get_field('background');
$title_header = get_field('titre_page');?>

<?php get_template_part( 'templates-parts/header-nav');?>

<header id="header" style="background:url('<?php echo $bg_header['url'];?>');">
</header>

<section id="intro_service">
    <div class="container">
        <div class="block_title"
            style="background:url('<?php echo get_template_directory_uri();?>/assets/img/background_titre_service.jpg;">
            <?php echo $title_header;?>
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

<section id="aboutus" class="aboutsolutions">
    <div class="container">
        <div class="grid">
            <?php if(have_rows('services')): 
                while(have_rows('services')): the_row();?>
            <?php $img = get_sub_field('background_service') ;
            
            $link = get_sub_field('lien_service');?>
            <a href="<?php echo $link['url'];?>">
                <div class=" card from-bottom"
                    style="background:url(<?php echo $img['url'];?>) center;background-size:cover;">
                    <h4><?php echo get_sub_field('nom_service');?></h4>
                </div>
            </a>
            <?php endwhile;
            endif;?>
        </div>
    </div>
</section>

<section id="assurance_nos">
    <div class="container">
        <?php get_template_part( 'templates-parts/section-assurance' );?>
    </div>
</section>


<section id="contact-service">
    <?php get_template_part( 'templates-parts/contact' );?>
</section>
<?php get_footer();