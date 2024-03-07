<?php 

$titreCol2 = get_field('titre-colonne-2','options');
$titreCol3 = get_field('titre-colonne-3','options');
$cttCol3 = get_field('contenu_colonne_3','options');
$form = get_field('formulaire-nl','options');

?>

<footer>
    <div class="container">
        <div class="footer-top">
            <div class="col general-infos">
                <?php $logo = get_field('logo_footer','options');?>
                <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['title'];?>" />

                <div class="adresse">
                    <?php 
                        $adresse = get_field('adresse','options');
                        if($adresse): echo $adresse; endif;
                    ?>
                </div>
            </div>

            <div class="col col-2">
                <?php if($titreCol2): echo '<h4>'.$titreCol2.'</h4>';endif;?>
                
                <?php
                wp_nav_menu( array(
                    'menu' => 'Menu Footer',
                    'theme_location' => 'footer',
                    'menu_class' => 'semi-bold nav'
                ) );?>
            </div>

            <div class="col rs_footer">
                <?php 

                if($titreCol3): echo '<h4>'.$titreCol3.'</h4>';endif;
                if($cttCol3): echo $cttCol3;endif;

                if($form): echo do_shortcode($form);endif;
                
                ?>
            </div>
        </div>
    </div>
    <div class="footer_middle">
        <?php 
        $keywords = get_field('keywords','options');

        if($keywords):
            echo '<span class="keywords">'.$keywords.'</span>';
        endif;?>
    </div>
    <div class="footer_bottom">
        <div class="container desktop">
            <a href="">Cookies</a>
            <div>
                <?php echo get_field('copyright','options');?>
            </div>
            <a href="">Confidentialité</a>
        </div>

        <div class="container mobile">
            <div class="links">
                <a href="">Cookies</a>
                <a href="">Confidentialité</a>
            </div>

            <div class="copyright">
                <?php echo get_field('copyright','options');?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>