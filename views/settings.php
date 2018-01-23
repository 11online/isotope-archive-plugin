<?php









?>


<div class="wrap">
    <h1>Your Plugin Page Title</h1>

    <form method="post" action="options.php">


        <label for="filtering_post_type">Select Post Type</label>
        <select id="filtering_post_type" name="filtering_post_type">
            <?php
            foreach ( get_post_types( '', 'names' ) as $post_type ) {
                echo '<option value="' . $post_type .'">' . $post_type . '</option>';
            }
            ?>

        </select>

        <label for="filtering_number_posts">Number of Posts</label>
        <select id="filtering_number_posts" name="filtering_number_posts">
            <option value="1">1</option>
            <option value="2">2</option>

        </select>

        <label for="filtering_columns">Number Of Columns</label>
        <select name="filtering_columns" id="filtering_columns">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>

        <label for="filtering_taxonomy">Taxonomy</label>
        <select name="filtering_taxonomy" id="filtering_taxonomy">
<?php
            $taxonomies = get_taxonomies();
            foreach ( $taxonomies as $taxonomy ) {
            echo '<option value="'. $taxonomy . '">' . $taxonomy . '</option>';
            }
            ?>
        </select>

        <label for="filtering_color">Color</label>
        <select id="filtering_color" name="filtering_color">
            <option value="blue">Blue</option>
            <option value="red">Red</option>
        </select>


        <button type="submit" id="submit">Submit</button>

    </form>

    <div id="new-shortcode"></div>
</div>