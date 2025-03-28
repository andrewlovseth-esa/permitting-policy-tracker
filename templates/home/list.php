<section id="actions-list" class="actions-list | content-grid">

    <?php
        $total_posts = get_total_actions_count();

        $args = array(
                'post_type' => 'actions',
                'posts_per_page' => 500,
                'orderby' => 'date',
                'order' => 'DESC'
            );

            // Initialize tax query array if we have any taxonomy filters
            $tax_query = array();

            // Add keyword search if set
            if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                $keyword = sanitize_text_field($_GET['keyword']);
                $args['s'] = $keyword; // This searches the post title
            }

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

            // Add sub-component filter if set
            if(isset($_GET['sub_component']) && !empty($_GET['sub_component'])) {
                $tax_query[] = array(
                    'taxonomy' => 'sub-component',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($_GET['sub_component'])
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
            ?>
            
                <div class="actions-list__header">
                    <h2 class="actions-list__title">
                        <span class="actions-list__title--text">List of Actions</span>
                        
                        <span class="count">
                            <span class="count__total">Total Actions: <?php echo $total_posts; ?></span>
                            <?php if($query->found_posts !== $total_posts) : ?>
                                <span class="count__filtered">Displaying <?php echo $query->found_posts; ?> Filtered <?php echo $query->found_posts === 1 ? 'Action' : 'Actions'; ?></span>
                            <?php endif; ?>
                        </span>
                    </h2>
                </div>

                <?php if ( $query->have_posts() ) : ?>

                    <div class="actions-list__body | list">
            
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                            <?php
                                $post_date = get_the_date('F j, Y'); 
                                if ($current_date !== $post_date) :
                            ?>

                            <!-- Close previous date group -->
                            <?php if ($current_date !== '') : ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="date-group">
                                <h2 class="date-header | sub-header"><?php echo $post_date; ?></h2>
                            
                            <?php $current_date = $post_date; endif; ?>

                        <?php get_template_part('components/actions/action'); ?>

                    <?php endwhile; ?>

                    <!-- Close last date group -->
                    <?php if ($current_date !== '') : ?>
                        </div>
                    <?php endif; ?>
                </div>

            <?php else : ?>
                
                <?php get_template_part('components/actions/action-none'); ?>

    <?php endif; wp_reset_postdata(); ?>

</section>
