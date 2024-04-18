<?php 
    $color_bg = get_field('arriere_plan-color');
    $img = get_field('image_about','options');
    $intro = get_field('introduction','options');
    $textApropos = get_field('texte_apropos','options');
    $btn = get_field('lien_about','options');
?>

<div class="section-introduction">
    <div class="colg">
        <?php if($intro): echo '<span class="from-bottom">' . $intro . '</span>'; endif;?>
        <?php if($img):?>
            <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" class="from-bottom" />
        <?php endif;?>
    </div>
    <div class="cold">
        <?php if($textApropos): echo '<span class="from-bottom">' . $textApropos . '</span>'; endif;?>
        <?php if($btn): ?><a href="<?php echo $btn['url'];?>" class="cta from-bottom"><?php echo $btn['title'];?></a><?php endif;?>
    </div>
</div>