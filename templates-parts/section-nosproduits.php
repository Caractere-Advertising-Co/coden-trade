<?php 

if(is_front_page(  )):
    $title = get_field('titre-vosp');
    $baseline = get_field('baseline-vosp');
    $catProd = get_field('categories-produits');
else :
    $title = get_field('titre_section_con', 'options' );
    $baseline = get_field('soutitre_section_cons', 'options' );
    $catProd = null;
endif;
?>

<div class="section_vosp container from-bottom">
    <?php 
    if($title || $baseline): echo '<span class="from-bottom">'. $title . '</span><h3 class="from-bottom">'.$baseline.'</h3>';endif;
    
    echo '<div class="list-btn">';
    if($catProd):
        foreach($catProd as $cP):
            echo '<a class="cta-border round" value="'.$cP->name.'" data-filter="'.$cP->slug.'">'.$cP->name.'</a>';
        endforeach;
    ;endif?>
</div>