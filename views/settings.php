<?php


?>


<div class="wrap plugin-admin-screen">
    <h1>Isotope.js Archive Plugin</h1>

    <form method="post" action="options.php">


        <label for="filtering_post_type">Select Post Type</label>
        <div class="settings">
            <select id="filtering_post_type" name="filtering_post_type">
                <?php
                foreach (get_post_types('', 'names') as $post_type) {
                    echo '<option value="' . $post_type . '">' . $post_type . '</option>';
                }
                ?>

            </select>
        </div>

        <label for="filtering_columns">Number Of Columns</label>
        <div class="settings">
            <select name="filtering_columns" id="filtering_columns">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>


        <label for="filtering_taxonomy">Taxonomy</label>
        <div class="settings">
            <select name="filtering_taxonomy" id="filtering_taxonomy">
                <?php
                $taxonomies = get_taxonomies();
                foreach ($taxonomies as $taxonomy) {
                    echo '<option value="' . $taxonomy . '">' . $taxonomy . '</option>';
                }
                ?>
            </select>
        </div>

        <label for="filtering_color">Color</label>
        <div class="settings">
            <input type="text" id="filtering_color" value="#bada55" class="my-color-field"
                   data-default-color="#effeff"/>
        </div>

        <div class="submit-button">
            <button type="submit" id="submit">Submit</button>
        </div>

    </form>

    <label id='label-shortcode' for="new-shortcode"></label>
    <div id="new-shortcode"></div>
</div>