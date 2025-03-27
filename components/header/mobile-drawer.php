<?php if(have_rows('header_nav', 'options')): ?>
    <div id="mobile-drawer">
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