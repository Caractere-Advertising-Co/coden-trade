<div class="container top_content">
    <?php 
        $titre_cons = get_field('titre_section_con','options');
        $soutitre_cons = get_field('soutitre_section_cons','options');

        if($titre_cons): echo $titre_cons; endif;
        if($soutitre_cons): echo '<h3>'.$soutitre_cons.'</h3>'; endif;
    ?>
</div>