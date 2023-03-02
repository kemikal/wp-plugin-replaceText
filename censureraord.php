<?php
/*
Plugin Name: Censurera ord
Description: Vi hittar ett ord, och byter det till något annat
Version: 1.0
Author: Janne
*/

add_action("admin_menu", "censur_admin_menu");

function censur_admin_menu() {
    add_menu_page("Word Replace", "Word Replace", "manage_options", "wr-menu", "wr_admin_page");
    add_option("stringToLookFor", "");
    add_option("stringToReplaceTo", "");
}

function wr_admin_page() {
    ?>
    <div class="wrap">
        <h1>Censurera ord</h1>

        <?php
            if (isset($_POST["submit-btn"])) {
                update_option("stringToLookFor", $_POST["stringToLookFor"]);
                update_option("stringToReplaceTo", $_POST["stringToReplaceTo"]);
                ?>
                    <div class="updated">Sparad!</div>
                <?php
            }
        ?>

        <form method="POST">
            <div>Ersätt <?= get_option("stringToLookFor") ?> med <?= get_option("stringToReplaceTo") ?>.</div>
            <input type="text" name="stringToLookFor">
            <input type="text" name="stringToReplaceTo">
            <input type="submit" name="submit-btn" value="submit">
        </form>
    </div>
    <?php
}

function replaceTextInContent($content) {
    return str_replace(get_option("stringToLookFor"), get_option("stringToReplaceTo"), $content);
}

add_filter("the_content", "replaceTextInContent");

?>