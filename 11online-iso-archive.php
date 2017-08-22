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

function eo_enqueue() {
    wp_register_style('eo-isotope-archive-style', plugins_url('isotope-archive-plugin/css/style.css'));
    wp_enqueue_style('eo-isotope-archive-style');

    wp_register_script('eo-isotope-archive-script', plugins_url('isotope-archive-plugin/js/isotope.pkgd.min.js'), array('jquery'), '2.1', true);
    wp_enqueue_script('eo-isotope-archive-script');

    wp_register_script('eo-isotope-archive-init', plugins_url('isotope-archive-plugin/js/isotope_init.js'), array('jquery'), '2.1', true);
    wp_enqueue_script('eo-isotope-archive-init');
}
add_action( 'wp_enqueue_scripts', 'eo_enqueue' );

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


function generate_iso_archive($args) {
  
    // put defaults if no args are given
    extract(shortcode_atts(array(
        'arg_post_type' => 'post',
        'arg_column_size'    => 2,
        'arg_number_posts' => 10
    ), $args));
    
    ob_start();

    $post_args = array(
        'post_type'=> $arg_post_type,
        'order'    => 'ASC'
    );              
    
    $the_query = new WP_Query( $post_args );
    
    
    $terms = get_terms(array('taxonomy' => 'category', 'post_type' => $arg_post_type));
    $count = 0;

    // NEED TO TEST THIS! THIS IS WORKING WITH JUST INCLUDE.
    if ($arg_column_size == 2) {
        include('templates/2-col-archive.php');
    }
    
    return ob_get_clean();

}