<?php

/* Template Name: My account*/

$title = get_field('titre-account','options');
$content = get_the_content();

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
                wc_get_template( 'myaccount/form-login.php' );
                if($cta): echo '<a href="'.$cta['url'].'" class="cta-signup">'.$cta['title'].'</a>'; endif;
            endif;?>
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
