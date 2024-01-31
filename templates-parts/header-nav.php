<div class="header navigation">
    <div class="col-g">
        <a href="<?php echo home_url();?>">
            <?php $logo = get_field('logo-entreprise','options');?>
            <?php if($logo):?>
            <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['title'];?>" class="logo" />
            <?php endif;?>
        </a>
    </div>
    <div class="col-d">
        <div class="secondary-navigation">
            <?php wp_nav_menu(array(
                'menu' => 'top-header_menu',
                'theme_location' => 'topheader',
                'menu_class' => 'nav'
            ));?>
        </div>
        <div class="primary-navigation">
            <?php wp_nav_menu(array(
                'menu' => 'Navigation principale',
                'theme_location' => 'main',
                'menu_class' => 'semi-bold nav'
            ));?>
        </div>
    </div>
</div>