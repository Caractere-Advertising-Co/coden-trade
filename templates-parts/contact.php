<section id="contact">
    <div class="container from-bottom">
        <?php 
            $subtitle = get_field('sub_contact','options');
            $title = get_field('titre-contact','options');
            $titleContact = get_field('titre-page-contact','options');
            $form = get_field('shortcode_form','options');

        ?>
        <?php if($subtitle):?><p class="subtitle"><?php echo $subtitle;?></p><?php endif;?>
        
            
        <?php if(is_page(79097)):
                if($titleContact): echo $titleContact; endif;
            else :
             if($title):?> <h2><?php echo $title;?></h2><?php endif;
             endif;?>

        <?php if($form): echo do_shortcode( $form ); endif;?>
    </div>
</section>