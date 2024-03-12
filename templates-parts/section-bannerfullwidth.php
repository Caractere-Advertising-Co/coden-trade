<section id="banner-fullwidth">
    <div class="container">
        <?php if($title) : echo $title;endif;?>
        <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta">'.$cta['title'].'</a>'; endif;?>
    </div>
</section>