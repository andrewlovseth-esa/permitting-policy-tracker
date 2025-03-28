<?php 

/**
 * AJAX handler for getting sub-components of an agency
 */
function get_sub_components() {
    $agency_slug = $_POST['agency'] ?? '';
    
    if (empty($agency_slug)) {
        wp_send_json_error('No agency provided');
        return;
    }

    // Get the agency term
    $agency = get_term_by('slug', $agency_slug, 'agency');
    
    if (!$agency) {
        wp_send_json_error('Agency not found');
        return;
    }

    // Get the sub-components from ACF field
    $sub_components = get_field('sub_components', 'agency_' . $agency->term_id);
    
    if (!$sub_components || !is_array($sub_components)) {
        wp_send_json_success([]);
        return;
    }

    // Filter and format the sub-components that have posts
    $formatted_sub_components = array_filter(array_map(function($term) {
        // Query to count posts of type 'actions' with this sub-component
        $count = get_posts([
            'post_type' => 'actions',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'tax_query' => [
                [
                    'taxonomy' => 'sub-component',
                    'field' => 'term_id',
                    'terms' => $term->term_id
                ]
            ]
        ]);
        
        // Only return terms that have action posts
        if (count($count) > 0) {
            return [
                'slug' => $term->slug,
                'name' => $term->name
            ];
        }
        return null;
    }, $sub_components));

    wp_send_json_success(array_values($formatted_sub_components));
}
add_action('wp_ajax_get_sub_components', 'get_sub_components');
add_action('wp_ajax_nopriv_get_sub_components', 'get_sub_components');
