<div class="site-header__mobile">
    <?php get_template_part('components/header/logo'); ?>

    <div class="site-header__hamburger hamburger">
        <a href="#" class="hamburger__link js-nav-trigger">
            <div class="hamburger__buns">
                <div class="hamburger__patty"></div>
            </div>
        </a>
    </div>

    <?php if(have_rows('header_nav', 'options')): ?>
        <div id="mobile-nav">
            <ul class="site-nav site-nav__mobile">
                <?php while(have_rows('header_nav', 'options')): the_row(); ?>

                    <?php 
                        $link = get_sub_field('link');
                        if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>

                        <li class="site-nav__mobile-item">
                            <a class="site-nav__mobile-link sans" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        </li>

                    <?php endif; ?>
                <?php endwhile; ?> 
            </ul>    
        </div>
    <?php endif; ?>
</div>