<div class="header navigation">
    <div class="col-g">
        <a href="<?php get_bloginfo('url');?>">
        <?php $logo = get_field('logo-entreprise','options');?>
            <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['title'];?>" class="logo"/>
        </a>
    </div>
    <div class="col-d">
        <div class="secondary-navigation">
            <?php wp_nav_menu(array(
                'menu' => 'top-header_menu',
                'theme_location' => 'primary'
            ));?>
        </div>
        <div class="primary-navigation"></div>
    </div>
</div>