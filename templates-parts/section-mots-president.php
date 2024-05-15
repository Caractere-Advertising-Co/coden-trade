<?php

if($args['titre_tirth_para']):

    $titrePresident = $args['titre_tirth_para'];
    $txtPresident = $args['texte_tirth_para'];
    $galerie = $args['galerie_tirth_para'];
    $img = null;
    $cta = $args['cta_tirth_para'];

else :

    $titrePresident =
    $txtPresident = get_field('texte_du_president','options');
    $galerie = get_field('galerie_service','options');
    $img = null;
    $cta = get_field('cta_service','options');

endif;
?>

<section id="mot_president">
    <div class="container">
        <div class="columns">
            <div class="col-g">
                <?php if($titrePresident): echo $titrePresident;endif;?>
                <?php if($txtPresident): echo $txtPresident; endif;?>
                
            </div>
            <div class="col-d from-right">
                <?php if($img):?>
                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" class="from-left" />

                <?php elseif($galerie):?>
                    <div class="swiper swiper-blog">
                        <div class="swiper-wrapper">
                            <?php foreach($galerie as $g):?>
                                <div class="swiper-slide">
                                    <img src="<?php echo $g['url'];?>" alt="<?php echo $g['title'];?>"/>
                                </div>
                            <?php endforeach;?>
                        </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>

</section>