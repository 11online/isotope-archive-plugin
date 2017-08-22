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