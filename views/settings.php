<?php

$filtering_post_type = get_option("filtering_post_type");

echo $filtering_post_type;


?>


<div class="wrap">
    <h1>Your Plugin Page Title</h1>

    <form method="post" action="options.php">


        <label for="filtering_post_type">Select Post Type</label>
        <select id="filtering_post_type" name="filtering_post_type">
            <option value="post_type">A post type</option>
            <option value="another_post_type">Another post type</option>

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
            <option value="4">4</option>
        </select>

        <label for="filtering_taxonomy">Taxonomy</label>
        <select name="filtering_taxonomy" id="filtering_taxonomy">
            <option value="taxonomy_type">A taxonomy</option>
            <option value="taxonomy_test">Taxonomy</option>
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