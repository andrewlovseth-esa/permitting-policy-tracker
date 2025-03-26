<?php

function filter_actions() {
    // Get the template part content
    ob_start();
    include(get_template_directory() . '/templates/home/list.php');
    $content = ob_get_clean();
    
    // Return the content
    echo $content;
    die();
}
add_action('wp_ajax_filter_actions', 'filter_actions');
add_action('wp_ajax_nopriv_filter_actions', 'filter_actions'); 