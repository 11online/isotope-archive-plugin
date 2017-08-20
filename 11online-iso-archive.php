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

    // if args are present, set them
    // $post_type = $args['post-type'];
    // $column_size = $args['col'];
    // $excluded_cats = $args['exclude-cats'];
    // $number_posts = $args['number_posts'];
    
    ob_start();
    // $posts = get_posts( array(
    //     'numberposts' => $arg_number_posts,
    //     'orderby' => 'menu_order',
    //     'order' => 'ASC',
    //     'post_type' => $arg_post_type
    // )); //array of objects returned

    $post_args = array(
        'post_type'=> $arg_post_type,
        'order'    => 'ASC'
    );              
    
    $the_query = new WP_Query( $post_args );
    
    
    $terms = get_terms(array('taxonomy' => 'category', 'post_type' => $arg_post_type));
    $count = 0;
    
    ?>
    
    <div class="iso-archive-description">
            <?php if ($terms) { ?>
                <ul id="portfolio-cats" class="filter clearfix">
                    <li class="port-li port-first"><a href="#" class="active" data-filter="*"><span><?php _e('All', 'lp'); ?></span></a></li>
                    <?php
                    $first_count = 0;
                    foreach ($terms as $term) {
                        $first_class = '';
                        if ($first_count === 6 || $first_count === 13 || $first_count === 19) {
                            $first_class = 'port-first';
                        }
                        echo "<li class='port-li $first_class'><a href='#' data-filter='.$term->slug'><span>$term->name</span></a></li>";
                        $first_count++;
                    }
                    ?>
                </ul><!-- /portfolio-cats --><br/><br/>
            <?php } ?>
            
                <div id="portfolio-wrap" class="clearfix filterable-portfolio">
                    <div class="portfolio-content">
                        <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                            <?php $count++; ?>
                            <?php $terms = get_the_terms(get_the_ID(), 'category'); ?>
                            <?php $status = get_the_terms(get_the_ID(), 'status'); ?>
                            <?php if (has_post_thumbnail($post->ID)) { ?>
                                <article
                                        class="portfolio-item col-<?php echo $count; ?> <?php if ($terms) foreach ($terms as $term) {
                                            echo $term->slug . ' ';
                                        }; ?>">
                                    <div class="portfolio-img-background"
                                         style="background: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>); background-position: center center; background-repeat: no-repeat; background-size: cover; ">
                                        <a href="<?php the_permalink() ?>" rel="bookmark"
                                           title="<?php the_title_attribute(); ?>">
                                            <div class="portfolio-overlay">
                                                <h3><?php the_title(); ?></h3>
                                                <p><?php the_excerpt_max_charlength(150); ?></p>
                                                <div class="button">See More</div>
                                            </div><!-- overlay --></a>
                                    </div>
                                </article>
                            <?php } else { ?>
                            <article
                                    class="portfolio-item col-<?php echo $count; ?> <?php if ($terms) foreach ($terms as $term) {
                                        echo $term->slug . ' ';
                                    }; ?>">
                                <div class="portfolio-img-background"
                                     style="background-position: center center; background-repeat: no-repeat; ">
                                    <a href="<?php the_permalink() ?>" rel="bookmark"
                                       title="<?php the_title_attribute(); ?>">
                                        <div class="portfolio-overlay">
                                            <h3><?php the_title(); ?></h3>
                                            <p><?php the_excerpt_max_charlength(150); ?></p>
                                            <div class="button">See More</div>
                                        </div><!-- overlay --></a>
                                        </div>
                                    </article>
                                <?php }  ?>
                            <?php endwhile; ?>
                        </div><!-- /themes-content -->
                    </div><!-- /themes-wrap -->
        </div>
    <?php 
    return ob_get_clean();

}