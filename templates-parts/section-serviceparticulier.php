<?php 

if($args && $args['titre_tirth_para'] != null):

    $titreService = $args['titre_tirth_para'];
    $txtService = $args['texte_tirth_para'];
    $galerie_ser = $args['galerie_tirth_para'];
    $img = null;
    $cta_ser = $args['cta_tirth_para'];

    $bgService = null;
    $img = null;
else : 

    $titreService = get_field('titre_service','options');
    $txtService = get_field('texte_service','options');
    $galerie_ser = get_field('galerie_service','options');
    $cta_ser = get_field('cta_service');
    $bgService = get_field('background_service');
    $img = get_field('img-separator');
endif;

?>

<section id="service_particulier">
    <div class="container columns">
        <div class="colg">
            <?php if($titreService): echo $titreService; endif;?>
            <?php if($txtService): echo $txtService; endif;?>
            <?php if($cta_ser):?>
                <a href="<?php $cta_ser['url'];?>" class="cta"><?php $cta_ser['title'];?></a>
            <?php endif;?>
        </div>
        <div class="cold">
            <div class="swiper swiper-service">
                <div class="swiper-wrapper">
                    <?php if($galerie_ser): 
                        foreach($galerie_ser as $gal):?>
                            <div class="swiper-slide">
                                <img src="<?php echo $gal['url'];?>" alt="<?php $gal['title'];?>"/>
                            </div>
                        <?php endforeach;
                    endif;?>
                </div>
                <div class="swiper-button-prev swiper-prev-about"></div>
                <div class="swiper-button-next swiper-next-about"></div>
            </div>
        </div>
    </div>

    <?php if(is_page_template( 'apropos.php' )):?>

        <div class="container">
            <?php if($titreService): echo $titreService; endif;?>
        </div>

        <div class="service-bottom" <?php if($bgService):?>style="background:url('<?php echo $bgService['url'];?>')no-repeat;background-position: left center;"<?php endif;?>>
            <?php $i = 0;?>
            <div class="container">
                <div class="cold">
                    <div class="col col-<?php echo $i;?>" id="tableau_service">                        
                        <?php
                            if(have_rows('liste_services')):
                                $count = count(get_field('liste_services'));

                                while(have_rows('liste_services')) : the_row();
                                    $card = get_sub_field('carte');
                                    $i++;

                                    $idSection;

                                    switch($i){
                                        case 1 :
                                            $idSection = "transport":
                                            break;
                                        case 2 : 
                                            $idSection = "contact":
                                            break;
                                        case 3 : 
                                            $idSection = "services":
                                            break;
                                        case 4 : 
                                            $idSection = "qualite":
                                            break;
                                        }
                                    
                                    if($card):?>
                                        <div class="card from-bottom" id="<?php echo $idSection;?>"><?php echo $card;?></div>
                                    <?php endif;?>

                                    <?php if($i == $count /2):?>
                                        </div><div class="col col-<?php echo $i;?>">
                                    <?php endif;
                                endwhile;
                            endif;
                        ?>
                    </div>
                </div>
            </div>

            <?php if($img):?>
                <div class="img-separator">
                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['url'];?>"/>
                </div>
            <?php endif;?>
        </div>
    <?php endif;?>
</section>