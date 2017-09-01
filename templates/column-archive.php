<div class="iso-archive-description">
    <?php if ($terms) { ?>
        <ul id="portfolio-cats" class="filter clearfix">
            <li class="port-li port-first"><a href="#" class="active" data-filter="*"><span><?php _e('All', 'lp'); ?></span></a></li>
            <?php
            foreach ($terms as $term) {
                echo "<li class='port-li'><a href='#' data-filter='.$term->slug'><span>$term->name</span></a></li>";
            }
            ?>
        </ul><!-- /portfolio-cats --><br/><br/>
    <?php } ?>
    
        <div id="portfolio-wrap" class="clearfix filterable-portfolio">
            <div class="portfolio-content">
                <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                    <?php $terms = get_the_terms(get_the_ID(), $taxonomy); ?>
                    <?php if (has_post_thumbnail($post->ID)) { ?>
                        <article
                                class="portfolio-item col-<?php echo $columns; ?> <?php if ($terms) foreach ($terms as $term) {
                                    echo $term->slug . ' ';
                                }; ?>">
                            <div class="portfolio-img-background"
                                    style="background: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>); background-position: center center; background-repeat: no-repeat; background-size: cover; ">
                                <a href="<?php the_permalink() ?>" rel="bookmark"
                                    title="<?php the_title_attribute(); ?>">
                                    <div class="portfolio-overlay" style="background-color: <?php echo $color; ?>;">
                                        <h3><?php the_title(); ?></h3>
                                        <p><?php the_excerpt_max_charlength(150); ?></p>
                                        <div class="button">See More</div>
                                    </div><!-- overlay --></a>
                            </div>
                        </article>
                    <?php } else { ?>
                    <article
                            class="portfolio-item col-<?php echo $columns; ?> <?php if ($terms) foreach ($terms as $term) {
                                echo $term->slug . ' ';
                            }; ?>">
                        <div class="portfolio-img-background"
                                style="background-position: center center; background-repeat: no-repeat; ">
                            <a href="<?php the_permalink() ?>" rel="bookmark"
                                title="<?php the_title_attribute(); ?>">
                                <div class="portfolio-overlay" style="background-color: <?php echo $color; ?>;">
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

    <style>
        .iso-archive-description ul.filter a:hover,
        .iso-archive-description ul.filter a.active {
            border-top: 4px solid <?php echo $color; ?>;
        }
    </style>