<div class="site-header__desktop">
    <div class="site-header__desktop-wrapper">
        <?php get_template_part('components/header/logo'); ?>

        <?php if(have_rows('header_nav', 'options')): ?>

            <ul class="site-nav site-nav__desktop" role="nav">
                <?php while(have_rows('header_nav', 'options')): the_row(); ?>

                    <?php 
                        $link = get_sub_field('link');
                        if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>

                        <li>
                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="sans">
                                <?php echo esc_html($link_title); ?>
                            </a>
                        </li>

                    <?php endif; ?>

                <?php endwhile; ?>
            </ul>
            
        <?php endif; ?>
    </div>
</div>