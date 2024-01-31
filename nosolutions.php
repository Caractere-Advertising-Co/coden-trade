<?php 
/* Template Name: Nos-solutions */ 

get_header();
$bg_header = get_field('background');
$title_header = get_field('titre_page');?>

<?php get_template_part( 'templates-parts/header-nav');?>

<header id="header" style="background:url('<?php echo $bg_header['url'];?>');">
</header>

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

<section id="intro_service">
    <div class="container">
        <?php
            $title_page = get_field('titre_service');
            $subtitle = get_field('subtitle');
            $content_intro = get_field('introduction');
        ?>
        <div class="colg title_nos">
            <h2><?php echo $subtitle;?></h2>
            <?php echo $title_page;?>
        </div>

        <div class="cold">
            <?php echo $content_intro;?>
        </div>
    </div>
</section>

<section id="presa_product">
    <div class="container">
        <div class="content_service">
            <?php if(have_rows('liste_service')):
        while(have_rows('liste_service')) : the_row();
        
        $link = get_sub_field('document');
        $icone = get_sub_field('icone');?>

            <a href="<?php echo $link['url'];?>" target="_blank">
                <div class="document_ddl">
                    <img src="<?php echo $icone['url'];?>" alt="icone_ddl" />
                    <p><?php echo $link['title'];?></p>
                </div>
            </a><?php 
endwhile;
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