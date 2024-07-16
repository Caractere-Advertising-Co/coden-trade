<?php 
/* Template Name: sinscrire */

get_header();

$subtitle = get_field('subtitle-sm');
$titre = get_field('titre_page');
$intro = get_field('introduction');
$cta = get_field('cta');

$bg_header = get_field('bg_header');

if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url = $bg_header['url'];
endif;?>


<header id="header" style="background:url('<?php echo $bg_url;?>');">
</header>

<section id="simple-page" class="page-inscription">
    <div class="container">
        <div class="colg">
            <div class="intro from-bottom">
                <h2><?php if($subtitle) : echo $subtitle;endif;?></h2>
                <?php if($titre) : echo $titre;endif;?>
            </div>
        </div>
        <div class="cold">
            <div class="intro from-bottom"><?php if($intro) : echo $intro; else : the_content();endif;?></div>
        </div>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-citation' );?>
<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();