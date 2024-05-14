<?php 
/* Template Name: Conseils */

get_header();

$title = get_field('titre');
$intro = get_field('introduction');
?>

<section id="introduction">
    <div class="container">
        <div class="colg">
            <?php if($title):
            echo $title;
        endif;?>
        </div>
        <div class="cold">
            <?php if($intro):
                echo $intro;
            endif;?>
        </div>
    </div>

    <div class="container">
        <div class="grid_articles">

            <?php if(have_rows('pdfFiles')):
                while(have_rows('pdfFiles')): the_row();
                    $pdf = get_sub_field('pdf');
                    echo do_shortcode($pdf);
                endwhile;
            endif;?>
        </div>
    </div>
</section>



<?php get_template_part( 'templates-parts/section-catalogue' );?>
<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();