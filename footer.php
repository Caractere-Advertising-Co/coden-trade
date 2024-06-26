<?php 

$titreCol2 = get_field('titre-colonne-2','options');
$titreCol3 = get_field('titre-colonne-3','options');
$cttCol3 = get_field('contenu_colonne_3','options');
$form = get_field('formulaire-nl','options');
$background = get_field('background-footer','options');

?>

<footer <?php if($background): echo 'style="background:url(\''.$background['url'].'\');background-size:cover;"';endif?>>
    <div class="container">
        <div class="footer-top">
            <div class="col general-infos">
                <?php $logo = get_field('logo_footer','options');?>
                <?php if($logo):?><img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['title'];?>" /><?php endif;?>

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

                // if($form): echo do_shortcode($form);endif;
                
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
        <?php
            $cookLink = get_field('lien_cookies','options');
            $confLink = get_field('lien_confi','options');
        ?>

        <div class="container desktop">
            <?php if($cookLink): echo "<a href=".$cookLink['url'].">".$cookLink['title']."</a>"; endif;?>
            <div>
                <?php 
                    $copyright = get_field('copyright','options');
                    if($copyright): echo $copyright; endif;
                ?>
            </div>
            <?php if($confLink): echo "<a href=".$confLink['url'].">".$confLink['title']."</a>"; endif;?>
        </div>

        <div class="container mobile">
            <div class="links">
                <?php if($cookLink): echo "<a href=".$cookLink['url'].">".$cookLink['title']."</a>"; endif;?>
                <?php if($confLink): echo "<a href=".$confLink['url'].">".$confLink['title']."</a>"; endif;?>
            </div>

            <div class="copyright">
            <?php 
                    $copyright = get_field('copyright','options');
                    if($copyright): echo $copyright; endif;
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>