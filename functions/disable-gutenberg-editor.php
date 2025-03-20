<?php

/*
	Disable Gutenberg Editor
*/


// Templates and Page IDs without editor
function bearsmith_disable_editor( $id = false ) {

	$excluded_templates = array(
		'templates/home.php',
	);

	$excluded_ids = array(
		// 1,		
	);

	if( empty( $id ) )
		return false;

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}


// Disable Gutenberg by template
function bearsmith_disable_gutenberg( $can_edit, $post_type ) {

	if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;

	if( bearsmith_disable_editor( $_GET['post'] ) )
		$can_edit = false;

	return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'bearsmith_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'bearsmith_disable_gutenberg', 10, 2 );


// Disable Classic Editor by template
function bearsmith_disable_classic_editor() {

	$screen = get_current_screen();
	if( 'page' !== $screen->id || ! isset( $_GET['post']) )
		return;

	if( bearsmith_disable_editor( $_GET['post'] ) ) {
		remove_post_type_support( 'page', 'editor' );
	}

}
add_action( 'admin_head', 'bearsmith_disable_classic_editor' );


// Disable Gutenberg by post type
function disable_gutenberg_by_post_type() {
	// Add post types you want to disable Gutenberg for
	$disabled_post_types = array(
		'actions',
	);

	// Disable Gutenberg for specified post types
	foreach ($disabled_post_types as $post_type) {
		add_filter('use_block_editor_for_post_type', function($can_edit, $type) use ($post_type) {
			if ($type === $post_type) return false;
			return $can_edit;
		}, 10, 2);
	}
}
add_action('init', 'disable_gutenberg_by_post_type');