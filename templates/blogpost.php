<!-- Disables pressing enter on textbox to submit form. -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on("keydown", ":input:not(textarea):not(:submit)", function(event) {
            return event.key != "Enter";
        });
    });
</script>

<!-- Checks if a blog post id has been given. -->
<?php

    //Includes the selection scripts.
    require $_SERVER["DOCUMENT_ROOT"]."/posts/select.php";
    
    //Selects all the blog posts to display for selection.
    $results = posts_select_all();

    //Gets the blog post id from the URL.
    $id = $_GET["id"];
    $pwd = $_POST["password"];

    //Checks if the id has been set.
    if(isset($id)){

        //Gets the blog post with the specified id.
        $results_post = posts_select_id($id);

        //Gets the first from from the database.
        $row = $results_post->fetch_assoc();

    }

?>

<!-- Blog post creation form. -->
<form action='<?php echo (isset($id) ? "/posts/edit.php" : "/posts/create.php") ?>' method="post">
    <div class="admin">
        <h1>Create a Blog Post</h1>
        <hr>
        <table style="margin:auto">
            <tbody>
                <tr>
                    <td>
                        <h2 class="admin_label">Amazon:</h2>
                    </td>
                    <td>
                        <input type="text" name="amazon_link" placeholder="Amazon link..." maxlength="500" value="<?php echo (isset($id) ? $row["amazon_link"] : "") ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2 class="admin_label">Booktopia:</h2>
                    </td>
                    <td>
                        <input type="text" name="booktopia_link" placeholder="Booktopia link..." maxlength="500" value="<?php echo (isset($id) ? $row["booktopia_link"] : "") ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2 class="admin_label">Webiste:</h2>
                    </td>
                    <td>
                        <input type="text" name="web_site" placeholder="Website name..." maxlength="16" value="<?php echo (isset($id) ? $row["web_site"] : "") ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2 class="admin_label">Webiste #2:</h2>
                    </td>
                    <td>
                        <input type="text" name="web_site_2" placeholder="Website name #2..." maxlength="16" value="<?php echo (isset($id) ? $row["web_site_2"] : "") ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2 class="admin_label">Category:</h2>
                    </td>
                    <td>
                        <input type="text" name="category" placeholder="Category..." maxlength="50" value="<?php echo (isset($id) ? $row["category"] : "") ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2 class="admin_label">Image:</h2>
                    </td>
                    <td>
                        <input type="text" name="image" placeholder="(ex. book_image.png)" maxlength="32" value="<?php echo (isset($id) ? $row["image"] : "") ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2 class="admin_label">Stars:</h2>
                    </td>
                    <td>
                        <select name="stars" style="width:100%">
                            <option <?php echo (isset($id) && (intval($row["stars"]) == 0)  ? "selected" : "") ?>>0</option>
                            <option <?php echo (isset($id) && (intval($row["stars"]) == 1)  ? "selected" : "") ?>>1</option>
                            <option <?php echo (isset($id) && (intval($row["stars"]) == 2)  ? "selected" : "") ?>>2</option>
                            <option <?php echo (isset($id) && (intval($row["stars"]) == 3)  ? "selected" : "") ?>>3</option>
                            <option <?php echo (isset($id) && (intval($row["stars"]) == 4)  ? "selected" : "") ?>>4</option>
                            <option <?php echo (isset($id) && (intval($row["stars"]) == 5)  ? "selected" : "") ?>>5</option>
                            <option <?php echo (isset($id) && (intval($row["stars"]) == 6)  ? "selected" : "") ?>>6</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2 class="admin_label">Date:</h2>
                    </td>
                    <td>
                        <?php
                            $time = strtotime($row["date"]); 
                            $date = date("Y-m-d", $time);
                        ?>
                        <input style="width:100%" type="date" name="date" value="<?php echo (isset($id) ? $date : "") ?>">
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <table style="width:100%; margin:auto">
            <tbody>
                <tr>
                    <td style="text-align:center">
                        <h2 class="admin_label">
                            Title:
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center">
                        <input style="width:100%;" type="text" name="title" placeholder="Title..." maxlength="500" value="<?php echo (isset($id) ? $row["title"] : "") ?>">
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center">
                        <h2 class="admin_label">
                            Description:
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center">
                        <?php

                            //Gets the description value.
                            $description = htmlspecialchars((isset($id) ? $row["description"] : ""), ENT_QUOTES, 'UTF-8');

                        ?>
                        <textarea class="admin_blog_post_body" name="description" placeholder="Description..." maxlength="2000"><?=$description?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center">
                        <h2 class="admin_label">
                            Body:
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center">
                        <?php

                            //Gets the description value.
                            $blog_post = htmlspecialchars((isset($id) ? $row["blog_post"] : ""), ENT_QUOTES, 'UTF-8');

                        ?>
                        <textarea class="admin_blog_post_body" name="blog_post" placeholder="Blog Post..." maxlength="10000"><?=$blog_post?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top:20px;">
            <input type="submit" name="submit" value="<?php echo (isset($id) ? "Edit Post" : "Create Post") ?>">
            <input type="hidden" name="id" value='<?=$id?>'>
        </div>
    </div>
</form>
<div>
    <?php

        //Loops through the results of the blog posts.
        while($row = $results->fetch_assoc()){

            //Gets formatted date and time.
            $time = strtotime($row["date"]);
            $date = date("d F Y", $time);

            //Prints out the blog post title.
            echo    "
                    <div class='admin' style='text-align:left'>
                        <form method='post' action='/admin.php?id=".$row["blog_id"]."'>
                            <table style='width:100%'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table style='width:100%'>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h3 class='post_category'>
                                                                ".$row["category"]."
                                                            </h3>
                                                        </td>
                                                        <td>
                                                            <h3 class='post_date'>
                                                                ".$date."
                                                            </h3>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h1 class='post_title'>
                                                ".$row["title"]."
                                            </h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type='hidden' name='password' value='".$pwd."'>
                                            <input type='submit' value='Edit'>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    ";

        }
    ?>
</div>