<?php

add_action('enqueue_block_editor_assets', function() {
	wp_enqueue_script(
		'vca-block-styles',
		get_template_directory_uri() . '/vca-block-styles/blocks.js',
		['wp-blocks']
	);
});

add_action( 'after_setup_theme', function() {

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue block editor stylesheet.
	add_editor_style( 'assets/dist/css/editor/editorStyles.css' );
});