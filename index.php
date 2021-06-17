<html>

    <!-- Webpage title. -->
    <title>Home</title>

    <!-- Includes the header onto the page. -->
    <?php include("templates/header.php"); ?>

    <?php

        //Includes the post select functions.
        require $_SERVER["DOCUMENT_ROOT"]."/posts/select.php";

        //Gets the blog id, category, and archive.
        $post_id = $_GET["id"];
        $post_category = $_GET["category"];
        $post_archive = $_GET["archive"];

        //Checks if the post id has been sepecified.
        if(isset($post_id)){

            //Gets the blog post with the specified id.
            $results = posts_select_id($post_id);

            //Gets the first from from the database.
            $row = $results->fetch_assoc();

        }else if(isset($post_category)){
                    
            //Gets all the posts with the specified category.
            $results = posts_select_category("james_clifton", $post_category);

        }else if(isset($post_archive)){

            //Gets all the posts in the specified archive.
            $results = posts_select_archive("james_clifton", strtotime($post_archive));

        }else{

            //Selects the most recent entry from the database.
            $results = posts_select_recent("james_clifton", 1);

            //Gets the first from from the database.
            $row = $results->fetch_assoc();

        }
        
    ?>

    <!-- Displays a fully expanded blog post. -->
    <div class="main" <?php echo ((isset($post_category) || isset($post_archive)) ? "hidden" : ""); ?>>
        <div class="post_holder">
            <div class="post">

                <!-- Category and creation date. -->
                <table style="width:100%">
                    <tbody>
                        <tr>
                            <td>
                                <h3 class="post_category">
                                    <?php echo $row["category"]; ?>
                                </h3>
                            </td>
                            <td>
                                <h3 class="post_date">
                                    <?php
                                        $time = strtotime($row["date"]); 
                                        echo date("d F Y", $time);
                                    ?>
                                </h3>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Post title and body. -->
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h1 class="post_title">
                                    <?php echo $row["title"]; ?>
                                </h1>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="post_body">
                                    <?php echo $row["blog_post"]; ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h3 class="post_footer">
                    by James Clifton
                </h3>
            </div>
        </div>
    </div>

    <!-- Displays a list of collapsed blog posts. -->
    <div class="main" <?php echo ((isset($post_category) || isset($post_archive)) ? "" : "hidden"); ?>>
        <div class="subpost_holder">

            <!-- Loops through all the results found in the database. -->
            <?php

                //Loops through the results from the database.
                while($row = $results->fetch_assoc()){

                    //Checks if the first row is not set.
                    if(isset($row)){

                        //Gets the formatted time for the blog post.
                        $time = strtotime($row["date"]);
                        $date = date("d F Y", $time);

                        //Prints out a subpost to be selected.
                        echo    "
                                    <div class='subpost'>
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
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h1 class='subpost_title'>
                                                            ".$row["title"]."
                                                        </h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class='subpost_body'>
                                                            ".$row["blog_post"]."
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <input type='button' value='Continue Reading' style='float:right' onclick=\"location.href='/index.php?id=".$row["blog_id"]."';\">
                                    </div>
                                ";

                    }

                }

                //Checks if results are empty.
                if(mysqli_num_rows($results) == 0){

                    //Prints out an error message.
                    echo "<div class='post'>Sorry, couldn't find and blog posts...</div>";

                }

            ?>
        </div>
    </div>

    <!-- Includes the sidebar onto the page. -->
    <?php include("templates/sidebar.php"); ?>

    <!-- Includes the footer onto the page. -->
    <?php include("templates/footer.php"); ?>

</html>
