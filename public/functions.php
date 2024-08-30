<?php
function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// Function to display ads
function display_ads($location) {
    if ($location == 'sidebar') {
        get_template_part('template-parts/ad-sidebar');
    } elseif ($location == 'footer') {
        get_template_part('template-parts/ad-footer');
    }
}
?>
