<?php if(have_rows('footer_nav', 'options')): ?>
    <ul class="site-nav site-nav__footer" role="nav">
        <?php while(have_rows('footer_nav', 'options')): the_row(); ?>

            <?php 
                $link = get_sub_field('link');
                if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>

                <li class="site-nav__footer-item">
                    <a class="site-nav__footer-link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                </li>

            <?php endif; ?>
        <?php endwhile; ?>   
    </ul>
<?php endif; ?>