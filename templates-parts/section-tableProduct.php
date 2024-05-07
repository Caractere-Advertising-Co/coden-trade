<div class="table_product">
        <?php 
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 9
        );  

        $query = new WP_Query($args);

        if($query->have_posts()):
            while($query->have_posts()): $query->the_post();?>

            <?php 
                $pid = $query->ID;
                $price = get_post_meta( get_the_ID(), '_price', true);
                $cat = get_the_terms( $pid, 'product_cat' );
                $tags = get_the_terms( $pid, 'product_tag' );
                $liens = $query->guid;

                if($tags):
                    foreach($tags as $t):
                        switch($t->name){
                            case 'Promo':
                                $tagClass = '-white';
                                break;
                            case 'New':
                                $tagClass = '-black';
                                break;
                            default:
                            $tagClass = '';
                            break;
                        }
                    endforeach;
                endif;
            ?>

            <div class="card_product <?php foreach($cat as $c): echo $c->slug . ' ';endforeach;?>">
                <a href="<?php echo the_permalink();?>">
                    <?php if($tags): ?>
                        <div class="bubble <?php echo $tagClass;?>">
                            <p><?php foreach($tags as $t): echo $t->name; endforeach;?></p>
                        </div>
                    <?php endif;

                        echo '<div class="thumbs"><img src="'.get_the_post_thumbnail_url( ).'"/></div>';
                        
                        if($cat):
                            echo '<h4 class="cat">'.$cat[0]->slug .'</h4>';
                        endif;

                        echo '<span class="title"><h3>'.get_the_title().'</h3></span>';
                        echo '<p class="price"> Àpd '.$price.' €</p>';
                    ?>
                </a>
            </div>

            <?php endwhile;
        endif;

        wp_reset_postdata();?>
    </div>