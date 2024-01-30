<section id="contact">
    <div class="container">
        <?php 
            $subtitle = get_field('sub_contact','options');
            $title = get_field('titre-contact','options');

        ?>
        <p class="subtitle"><?php echo $subtitle;?></p>
        <h2><?php echo $title;?></h2>


        <?php echo do_shortcode( '[contact-form-7 id="26a2b4a" title="Contact Information"]' );?>
    </div>
</section>