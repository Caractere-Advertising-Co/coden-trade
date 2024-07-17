<?php

/* Template Name: My account*/

$title = get_field('titre-account','options');
$content = get_the_content();

$img = get_field('image_disclaimer_inscription','options');
$content_insc = get_field('content_disclaimer_inscription','options');

$cta = get_field('cta_inscription','options');

get_header();?>

<section id="myaccount">
    <div class="container">
        <?php if(!is_user_logged_in(  )):
            if($title): echo $title;endif;
        else : 
        endif;?>

        <div class="woocommerce-MyAccount-content">
            <?php if(is_user_logged_in(  )):    
                do_action( 'woocommerce_account_content' );
                do_action( 'woocommerce_account_navigation' );
            else : 
                wc_get_template( 'myaccount/form-login.php' );?>

                <div class="container columns" id="notYetClient">
                        <div class="colg from-left">
                            <?php if($img):?>
                                <div class="block-img">
                                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>"/>
                                </div>
                            <?php endif;?>
                        </div>

                        <div class="cold from-right">
                            <?php if($content_insc): echo $content_insc;endif;?>
                            <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta cta-signup">'.$cta['title'].'</a>'; endif;?>
                        </div>
                    </div>
            <?php endif;?>
        </div>
    </div>
</section>
<section id="nos_connaissances">
    <div class="container top_content">
        <?php get_template_part( 'templates-parts/section-citation'); ?>
    </div>
</div>

<?php get_template_part( 'templates-parts/section-confiance' );


get_footer();
