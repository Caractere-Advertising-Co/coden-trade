<div class="header navigation <?php if(!is_front_page(  ) &&  !is_page(80802)): echo 'borBot';endif;?>">
    <div class="col-g">
        <a href="<?php echo home_url();?>" class="logo" >
            <?php 
            
            $logo = get_field('logo-entreprise','options');
            $logoBlack = get_field('logo-negatif','options');

            if($logo || $logoBlack):
                if(is_front_page(  ) || is_page(80802)):?>
                    <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['title'];?>" width="271" height="90"/>
                <?php else :?>
                    <img src="<?php echo $logoBlack['url'];?>" alt="<?php echo $logoBlack['title'];?>" width="271" height="90"/>
                <?php endif;
            endif;?>
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
            <svg id="open_the_Mmenu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" stroke-width=".6"
                fill="rgba(0,0,0,0)" stroke-linecap="round" style="cursor: pointer">
                <path d="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7">
                    <animate dur="0.2s" attributeName="d"
                        values="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7;M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7" fill="freeze"
                        begin="start.begin" />
                    <animate dur="0.2s" attributeName="d"
                        values="M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7;M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7" fill="freeze"
                        begin="reverse.begin" />
                </path>
                <rect width="10" height="10" stroke="none">
                    <animate dur="2s" id="reverse" attributeName="width" begin="click" />
                </rect>
                <rect width="10" height="10" stroke="none">
                    <animate dur="0.001s" id="start" attributeName="width" values="10;0" fill="freeze" begin="click" />
                    <animate dur="0.001s" attributeName="width" values="0;10" fill="freeze" begin="reverse.begin" />
                </rect>
            </svg>
        </div>

    </div>
</div>

<div class="megamenu">
    <div class="primary-navigation">
        <?php wp_nav_menu(array(
            'menu' => 'Mega menu',
            'theme_location' => 'megamenu',
            'menu_class' => 'semi-bold nav'
        ));?>
    </div>
</div>