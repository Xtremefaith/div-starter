<?php 
/*
Feature Name:   Sidebars
Description:    All standard Div Truth theme sidebars are registered here, any additional sidebars can be added in the child theme version of this file
Developer URI:  http://www.PositiveElement.com
Description:    This is where all the theme sidebars are registered
*/

/**
 * REGISTER PRIMARY SIDEBAR
 * 
 * @author Nick Worth
 * @since 1.0
 * @param <BOOLEAN> $enabled
 */
function register_primary_sidebar($enabled=false){
    if($enabled) :
        register_sidebar(array(
            'id' => 'primary',
            'name' => __('Primary', 'div_theme'),
            'description' => __('The first (primary) sidebar.', 'div_theme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        )); 
    endif;
}

/**
 * REGISTER SECONDARY SIDEBAR
 * 
 * @author Nick Worth
 * @since 1.0
 * @param <BOOLEAN> $enabled
 */
function register_secondary_sidebar($enabled=false){
    if($enabled) :
        register_sidebar(array(
            'id' => 'secondary',
            'name' => __('Secondary', 'div_theme'),
            'description' => __('The first (secondary) sidebar.', 'div_theme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        )); 
    endif;
}

/**
 * REGISTER HEADER RIGHT
 * 
 * @author Nick Worth
 * @since 1.0
 * @param <BOOLEAN> $enabled
 */
function register_header_right($enabled=false){
    if($enabled) :
        register_sidebar(array(
            'id' => 'header-banner',
            'name' => __('Header Right', 'div_theme'),
            'description' => __('Header Right.', 'div_theme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));
    endif;
}

/**
 * REGISTER NAV SOCIAL ICONS
 * 
 * @author Nick Worth
 * @since 1.0
 * @param <BOOLEAN> $enabled
 */
function register_nav_social_icons($enabled=false){
    if($enabled) :
        register_sidebar(array(
            'id' => 'nav-social-icons',
            'name' => __('Navigation Social Icons', 'divtheme'),
            'description' => __('Use Social Profile widget for top bar navigation', 'divtheme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));
    endif;
}

/**
 * REGISTER FOOTER 1
 * 
 * @author Nick Worth
 * @since 1.0
 * @param <BOOLEAN> $enabled
 */
function register_footer_1($enabled=false){
    if($enabled) :
        register_sidebar(array(
            'id' => 'footer-1',
            'name' => __('Footer 1', 'divtheme'),
            'description' => __('Column 1 footer sidebar.', 'divtheme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));
    endif;
}

/**
 * REGISTER FOOTER 2
 * 
 * @author Nick Worth
 * @since 1.0
 * @param <BOOLEAN> $enabled
 */
function register_footer_2($enabled=false){
    if($enabled) :
        register_sidebar(array(
            'id' => 'footer-2',
            'name' => __('Footer 2', 'divtheme'),
            'description' => __('Column 2 footer sidebar.', 'divtheme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));
    endif;
}

/**
 * REGISTER FOOTER 3
 * 
 * @author Nick Worth
 * @since 1.0
 * @param <BOOLEAN> $enabled
 */
function register_footer_3($enabled=false){
    if($enabled) :
        register_sidebar(array(
            'id' => 'footer-3',
            'name' => __('Footer 3', 'divtheme'),
            'description' => __('Column 3 footer sidebar.', 'divtheme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));
    endif;
}

/**
 * REGISTER FOOTER 4
 * 
 * @author Nick Worth
 * @since 1.0
 * @param <BOOLEAN> $enabled
 */
function register_footer_4($enabled=false){
    if($enabled) :
        register_sidebar(array(
            'id' => 'footer-4',
            'name' => __('Footer 4', 'divtheme'),
            'description' => __('Column 4 footer sidebar.', 'divtheme'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));
    endif;
}

?>