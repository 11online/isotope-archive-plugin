<?php
/*
Plugin Name: Isotope Archive
Plugin URI: https://11online.us/
Description: A simple shortcode based isotope archive for posts.
Version: 1.0
Author: 11 Online
Author URI: https://11online.us
License: GPLv2
*/

// load isotope, but consider conditionally loading in styles in each individual template file when included

function eo_enqueue()
{
    wp_register_style('eo-isotope-archive-style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_style('eo-isotope-archive-style');

    wp_register_script('eo-isotope-archive-script', plugin_dir_url(__FILE__) . 'js/isotope.pkgd.min.js', array('jquery'), '2.1', true);
    wp_enqueue_script('eo-isotope-archive-script');

    wp_register_script('eo-isotope-archive-init', plugin_dir_url(__FILE__) . 'js/isotope_init.js', array('jquery'), '2.1', true);
    wp_enqueue_script('eo-isotope-archive-init');
}

add_action('wp_enqueue_scripts', 'eo_enqueue');

function the_excerpt_max_charlength($charlength)
{
    $excerpt = get_the_excerpt();
    $charlength++;
    if (mb_strlen($excerpt) > $charlength) {
        $subex = mb_substr($excerpt, 0, $charlength - 5);
        $exwords = explode(' ', $subex);
        $excut = -(mb_strlen($exwords[count($exwords) - 1]));
        if ($excut < 0) {
            echo mb_substr($subex, 0, $excut);
        } else {
            echo $subex;
        }
        echo '[...]';
    } else {
        echo $excerpt;
    }
}


add_shortcode('iso-archive', 'generate_iso_archive');


function generate_iso_archive($args)
{

    // put defaults if no args are given
    extract(shortcode_atts(array(
        'post_type' => 'post',
        'columns' => 2,
        'number_posts' => 999999,
        'taxonomy' => 'category',
        'color' => '#023268'
    ), $args));

    if ($columns > 3) {
        $columns = 3;
    }

    ob_start();

    $post_args = array(
        'post_type' => $post_type,
        'order' => 'ASC',
        'posts_per_page' => $number_posts,
        'taxonomy' => $taxonomy
    );

    $the_query = new WP_Query($post_args);


    $terms = get_terms(array('taxonomy' => $taxonomy, 'post_type' => $post_type));


    include('templates/column-archive.php');


    return ob_get_clean();

}

// create custom plugin settings menu
add_action('admin_menu', 'filtering_plugin_create_menu');
function filtering_plugin_create_menu()
{
    //create new sub-level menu
    add_submenu_page('options-general.php', 'Isotope Filtering Settings', 'Filtering Plugin', 'administrator', 'Isotope-filtering', 'plugin_settings_page');

}


// enqueue the admin js
function filtering_plugin_admin_enqueue($hook)
{
    if ($hook == 'settings_page_Isotope-filtering') {
        wp_enqueue_script('settings_page_script', plugin_dir_url(__FILE__) . 'views/js/settings.js');


        // Add the color picker css file
        wp_enqueue_style( 'wp-color-picker' );

        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'isotope-page-setting-script', plugin_dir_url(__FILE__) . 'views/js/settings.js', array( 'wp-color-picker' ), false, true );

    }



}

add_action('admin_enqueue_scripts', 'filtering_plugin_admin_enqueue');


function plugin_settings_page()
{
    // handle settings
    include_once('views/settings.php');

}



function load_custom_wp_admin_style($hook) {
    // Load only on ?page=mypluginname
    if($hook != 'settings_page_Isotope-filtering') {
        return;
    }
    wp_enqueue_style( 'custom_wp_admin_css', plugin_dir_url(__FILE__) . 'css/style.css');
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );