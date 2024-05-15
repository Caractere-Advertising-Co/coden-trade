<?php 

if($args && $args['titre_second_para'] != null):
    $titreExpert = $args['titre_second_para'];
    $txtExpert = $args['texte_second_para'];
    $ctaExpert = $args['cta_second_para'];
else :
    $titreExpert = get_field('Titre-expert','options');
    $txtExpert = get_field('texte-expert','options');
    $ctaExpert = get_field('cta-expert','options');
endif;?>

<section id="expert">
    <div class="container">
        <?php if($titreExpert): echo $titreExpert; endif;?>

        <div class="descr">
            <?php if($txtExpert): echo $txtExpert; endif;?>
            <?php if($ctaExpert):?>
                <a href="<?php echo $ctaExpert['url'];?>" class="cta round"><?php echo $ctaExpert['title'];?></a>
            <?php endif;?>
        </div>
    </div>
</section>