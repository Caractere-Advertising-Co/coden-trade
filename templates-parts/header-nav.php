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

        <div class="hamburger-menu">
            <svg class="hamburger-icon" viewBox="0 0 100 80" width="40" height="40">
                <rect width="100" height="20" rx="10"></rect>
                <rect y="30" width="100" height="20" rx="10"></rect>
                <rect y="60" width="100" height="20" rx="10"></rect>
            </svg>
        </div>

    </div>
</div>

<div class="megamenu">
    <div class="primary-navigation">
        <?php wp_nav_menu(array(
                'menu' => 'Navigation principale',
                'theme_location' => 'main',
                'menu_class' => 'semi-bold nav'
            ));?>
    </div>
</div>