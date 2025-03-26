<section id="actions-list" class="list | content-grid">
    <?php
        $args = array(
            'post_type' => 'actions',
            'posts_per_page' => 500,
            'orderby' => 'date',
            'order' => 'DESC'
        );

        // Initialize tax query array if we have any taxonomy filters
        $tax_query = array();

        // Add document type filter if set
        if(isset($_GET['document_type']) && !empty($_GET['document_type'])) {
            $tax_query[] = array(
                'taxonomy' => 'document-type',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['document_type'])
            );
        }

        // Add action status filter if set
        if(isset($_GET['action_status']) && !empty($_GET['action_status'])) {
            $tax_query[] = array(
                'taxonomy' => 'action-status',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['action_status'])
            );
        }

        // Add agency filter if set
        if(isset($_GET['agency']) && !empty($_GET['agency'])) {
            $tax_query[] = array(
                'taxonomy' => 'agency',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['agency'])
            );
        }

        // Add tax query to args if we have any filters
        if(!empty($tax_query)) {
            $args['tax_query'] = array(
                'relation' => 'AND',
                ...$tax_query
            );
        }

        $query = new WP_Query( $args );
        $current_date = '';
        
        if ( $query->have_posts() ) : ?>
        
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <?php            
                    $post_date = get_the_date('F j, Y');
                ?>

                <?php if ($current_date !== $post_date) : ?>

                    <!-- Close previous date group -->
                    <?php if ($current_date !== '') : ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="date-group">
                        <h2 class="date-header | sub-header"><?php echo $post_date; ?></h2>
                        
                <?php $current_date = $post_date; endif; ?>

                <?php get_template_part('components/actions/list-item'); ?>

            <?php endwhile; ?>

            <!-- Close last date group -->
            <?php if ($current_date !== '') : ?>
                </div>
            <?php endif; ?>

        <?php else : ?>
            
            <?php get_template_part('components/actions/list-item-none'); ?>
        
    <?php endif; wp_reset_postdata(); ?>
</section>





