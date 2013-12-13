<?php 
/*
Feature Name:   Sidebars
Description:    All standard Div Truth theme sidebars are registered here, any additional sidebars can be added in the child theme version of this file
Developer URI:  http://www.PositiveElement.com
Description:    This is where all the theme sidebars are registered
*/
function div_starter_register_sidebars() {
    register_sidebar(array(
        'id' => 'primary',
        'name' => __('Primary', 'div_theme'),
        'description' => __('The first (primary) sidebar.', 'div_theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'id' => 'secondary',
        'name' => __('Secondary', 'div_theme'),
        'description' => __('The second (secondary) sidebar.', 'div_theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'id' => 'headerright',
        'name' => __('Header Right', 'div_theme'),
        'description' => __('Header Right.', 'div_theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
}
    add_action( 'widgets_init', 'div_starter_register_sidebars' );

?>