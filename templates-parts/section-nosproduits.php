<?php 

if(is_front_page(  )):
    $title = get_field('titre-vosp');
    $baseline = get_field('baseline-vosp');
    $catProd = get_field('categories-produits');
else :
    $title = get_field('titre-vosp', 'options' );
    $baseline = get_field('baseline-vosp', 'options' );
    $catProd = get_field('categories-produits', 'options');
endif;
?>

<div class="section_vosp from-bottom">
    <div class="container">
    <?php 
    if($title || $baseline): echo '<span class="from-bottom">'. $title . '</span><h3 class="from-bottom">'.$baseline.'</h3>';endif;
    
    if($catProd):
        foreach($catProd as $cP):
            echo '<button class="cta-border" value="'.$cP->name.'" data-filter="'.$cP->slug.'">'.$cP->name.'</button>';
        endforeach;
    ;endif?>
    </div>
</div>