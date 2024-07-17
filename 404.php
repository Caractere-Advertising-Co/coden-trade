<?php 

$home = get_bloginfo('url');
$bg_header = get_field('bg_header');

$content = get_field('content_404','options');

if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url = $bg_header['url'];
endif;

get_header();?>


<header id="header" style="background:url('<?php echo $bg_url;?>');">
</header>

<div id="page_404">
    <div class="container">
        <?php if($content): echo $content; endif;?>
        <?php if($home): echo '<a href="'.$home.'" class="cta">Vers l\'accueil</a>'; endif;?>
    </div>
</div>


<?php get_footer();?>