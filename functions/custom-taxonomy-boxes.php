<?php

add_action('admin_menu', function() {
    remove_meta_box('document-typediv', 'actions', 'side');
    remove_meta_box('agencydiv', 'actions', 'side');
    remove_meta_box('sub-componentdiv', 'actions', 'side');
    remove_meta_box('action-statusdiv', 'actions', 'side');
});


add_action('add_meta_boxes', function() {
    add_meta_box('document_type_dropdown', 'Document Type', fn($post) => render_taxonomy_dropdown($post, 'document-type'), 'actions', 'side');
    add_meta_box('agency_dropdown', 'Agency', fn($post) => render_taxonomy_dropdown($post, 'agency'), 'actions', 'side');
    add_meta_box('sub_component_dropdown', 'Sub-Component', fn($post) => render_taxonomy_dropdown($post, 'sub-component'), 'actions', 'side');
    add_meta_box('action_status_dropdown', 'Action Status', fn($post) => render_taxonomy_dropdown($post, 'action-status'), 'actions', 'side');
});

function render_taxonomy_dropdown($post, $taxonomy) {
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'parent' => 0,
    ]);

    $current_term = wp_get_object_terms($post->ID, $taxonomy, ['fields' => 'ids']);
    $selected = $current_term ? $current_term[0] : 0;

    wp_nonce_field("save_taxonomy_{$taxonomy}", "taxonomy_nonce_{$taxonomy}");

    echo "<select name='taxonomy_dropdown_{$taxonomy}' id='taxonomy_dropdown_{$taxonomy}' style='width: 100%;'>";
    echo "<option value=''>— Select —</option>";
    foreach ($terms as $term) {
        echo sprintf(
            '<option value="%d"%s>%s</option>',
            $term->term_id,
            selected($selected, $term->term_id, false),
            esc_html($term->name)
        );
    }
    echo "</select>";
}

add_action('save_post', function($post_id) {
    $taxonomies = ['document-type', 'agency', 'sub-component', 'action-status'];

    foreach ($taxonomies as $taxonomy) {
        $nonce_key = "taxonomy_nonce_{$taxonomy}";
        $field_key = "taxonomy_dropdown_{$taxonomy}";

        if (!isset($_POST[$nonce_key]) || !wp_verify_nonce($_POST[$nonce_key], "save_taxonomy_{$taxonomy}")) {
            continue;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) continue;

        if (isset($_POST[$field_key])) {
            $term_id = intval($_POST[$field_key]);
            if ($term_id) {
                wp_set_post_terms($post_id, [$term_id], $taxonomy, false);
            } else {
                wp_set_post_terms($post_id, [], $taxonomy, false); // clear
            }
        }
    }
});