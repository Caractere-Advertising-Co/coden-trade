<?php 
/* Template Name: catalogue */

$bg_header = get_field('bg_header');

if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url = $bg_header['url'];
endif;

get_header();?>

<section id="banner_header" <?php if($bg_header):?> style="background:url('<?php echo $bg_url;?>');"<?php endif;?>></section>

<section id="catalogues-section">
    <div class="container">
        <?php $titre = get_field('titre');?>
        <?php if($titre): echo $titre; endif;?>
    </div>

    <div class="container content-catalogue">
        <?php echo do_shortcode( '[dflip id="80751" type="thumb"][/dflip]' );?>
    </div>
</section>

<?php get_template_part( 'templates-parts/contact' );?>
<?php get_footer();?>