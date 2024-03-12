<section id="disclaimer_banner">
    <?php 
    $bgBanner = get_field('arriere-plan_banner','options');
    $txtBanner = get_field('texte_banner','options');
    $imgBanner = get_field('image_banner','options');
    $ctaBanner = get_field('cta_banner','options');
    ?>

    <div class="container from-left"
        style="background:url('<?php echo $bgBanner['url'];?>') no-repeat;background-size:cover;">
            <?php if($txtBanner): echo $txtBanner; endif;?>
            <?php if($ctaBanner):?> <a href="<?php echo $ctaBanner['url'];?>" class="cta"><?php echo $ctaBanner['title'];?></a><?php endif;?>
    </div>
</section>