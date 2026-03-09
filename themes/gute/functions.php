<?php
/**
 * Automatically populate the content of the gutenberg test page.
 */
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
