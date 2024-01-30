<?php $color_bg = get_field('arriere_plan-color');?>

<div class="main-content" <?php echo $color_bg ? "style='background:#f7f8f9;'" : '';?>>
    <div class="col-g">
        <?php 
        $img = get_field('image_about');
                
        echo '<span class="from-bottom">' . get_field('introduction') . '</span>';?>
        <?php if($img):?>
            <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" class="from-bottom"/>
        <?php endif;?>
    </div>
    <div class="col-d">
        <?php echo '<span class="from-bottom">' . get_field('texte_apropos') . '</span>';?>
        
        <?php $btn = get_field('lien_about');?>

        <a href="<?php $btn['url'];?>" class="cta from-bottom"><?php echo $btn['title'];?></a>
    </div>
</div>