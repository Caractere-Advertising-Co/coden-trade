<section id="contact">
    <div class="container from-bottom">
        <?php 
            $subtitle = get_field('sub_contact','options');
            $title = get_field('titre-contact','options');
            $form = get_field('shortcode_form','options');

        ?>
        <?php if($subtitle):?><p class="subtitle"><?php echo $subtitle;?></p><?php endif;?>
        <?php if($title):?> <h2><?php echo $title;?></h2><?php endif;?>

        <?php if($form): echo do_shortcode( $form ); endif;?>
    </div>
</section>