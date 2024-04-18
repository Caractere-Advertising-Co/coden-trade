<?php 

$title = get_field('txt-bannerfullwidth','options');
$cta = get_field('cta-bannerfullwidth','options');?>

<section id="banner-fullwidth-dark">
    <div class="container">
        <?php if($title) : echo $title;endif;?>
        <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta">'.$cta['title'].'</a>'; endif;?>
    </div>
</section>