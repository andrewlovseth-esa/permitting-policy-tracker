<?php

require_once( plugin_dir_path( __FILE__ ) . '/functions/protected-content.php');

require_once( plugin_dir_path( __FILE__ ) . '/functions/theme-support.php');

require_once( plugin_dir_path( __FILE__ ) . '/functions/enqueue-styles-scripts.php');

require_once( plugin_dir_path( __FILE__ ) . '/functions/acf.php');

require_once( plugin_dir_path( __FILE__ ) . '/functions/disable-gutenberg-editor.php');

require_once( plugin_dir_path( __FILE__ ) . '/functions/svg.php');

require_once( plugin_dir_path( __FILE__ ) . '/functions/custom-taxonomy-boxes.php');

require_once( plugin_dir_path( __FILE__ ) . '/functions/ajax-handlers.php');

require_once( plugin_dir_path( __FILE__ ) . '/functions/sub-components.php');

/**
 * Get total number of actions posts
 * @return int Total number of actions posts
 */
function get_total_actions_count() {
    static $total_posts = null;
    
    if ($total_posts === null) {
        $total_query = new WP_Query([
            'post_type' => 'actions',
            'posts_per_page' => -1,
            'fields' => 'ids'
        ]);
        $total_posts = $total_query->found_posts;
    }
    
    return $total_posts;
}