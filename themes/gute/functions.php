<?php
// Automatically populate the content of the gutenberg test page.
add_action( 'after_switch_theme', function() {
    $content = '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Your Heading Here</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Your paragraph text goes here. Click any block to start editing!</p>
<!-- /wp:paragraph -->';

    wp_update_post( [
        'ID'           => 2,
        'post_title'   => 'Gutenberg Demo',
        'post_content' => $content,
        'post_status'  => 'draft',
    ] );
} );


// Remove all top-level admin menu items except Pages
add_action( 'admin_menu', function() {
    global $menu, $submenu;
    $keep = [ 'edit.php?post_type=page' ];
    foreach ( $menu as $key => $item ) {
        if ( ! empty( $item[2] ) && ! in_array( $item[2], $keep, true ) ) {
            remove_menu_page( $item[2] );
        }
    }
    $submenu = [];
}, 999 );

// Hide the admin toolbar on the front-end
add_filter( 'show_admin_bar', '__return_false' );

// Redirect any wp-admin page that isn't the block editor or Pages list
add_action( 'current_screen', function( $screen ) {
    $allowed_bases = [ 'edit', 'post' ];
    if ( ! in_array( $screen->base, $allowed_bases, true ) ) {
        wp_safe_redirect( admin_url( 'edit.php?post_type=page' ) );
        exit;
    }
} );

// Hide the preview dropdown in the block editor
add_action( 'enqueue_block_editor_assets', function() {
    wp_add_inline_script( 'wp-edit-post', '
        wp.domReady( function() {
            var style = document.createElement( "style" );
            style.textContent = ".editor-header__settings .editor-preview-dropdown, .edit-post-header__settings .editor-preview-dropdown { display: none !important; }";
            document.head.appendChild( style );
        } );
    ' );
} );