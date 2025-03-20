<section class="list | content-grid">


    <?php
        $args = array(
            'post_type' => 'actions',
            'posts_per_page' => 25
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>


        <?php get_template_part('components/actions/action'); ?>

    <?php endwhile; endif; wp_reset_postdata(); ?>


</section>





