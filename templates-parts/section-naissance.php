<?php 
$txtNaissance = get_field('txt_naissance','options');
$ctaNaiss = get_field('cta_naissance','options');
$galerie = get_field('galerie_naiss','options');?>

<section id="begin_entreprise">
    <div class="container columns">
        <div class="colg">
            <div class="swiper swiper-about">
                <div class="swiper-wrapper">
                    <?php if($galerie): 
                        foreach($galerie as $gal):?>
                            <div class="swiper-slide">
                                <img src="<?php echo $gal['url'];?>" alt="<?php $gal['title'];?>"/>
                            </div>
                        <?php endforeach;
                    endif;?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        <div class="cold">
            <?php if($txtNaissance): echo $txtNaissance; endif;?>
            <?php if($ctaNaiss):?>
                <a href="<?php $ctaNaiss['url'];?>" class="cta"><?php $ctaNaiss['title'];?></a>
            <?php endif;?>
        </div>
    </div>
</section>