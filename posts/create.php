<?php

    //Requires the database to create the blog posts.
    require $_SERVER["DOCUMENT_ROOT"]."/posts/database.php";

    //Gets all the blog post information.
    $web_site       = $_POST["web_site"];
    $web_site_2     = $_POST["web_site_2"];
    $category       = $_POST["category"];
    $image          = $_POST["image"];
    $stars          = $_POST["stars"];
    $date           = $_POST["date"];
    $amazon_link    = $_POST["amazon_link"];
    $booktopia_link = $_POST["booktopia_link"];
    $title          = $_POST["title"];
    $description    = $_POST["description"];
    $blog_post      = $_POST["blog_post"];
    $submit         = $_POST["submit"];

    //Checks if all the section have been set to a value.
    if(isset($web_site) && isset($category) && isset($stars) && isset($date) && isset($title) && isset($submit)){

        //Gets the insert sql statement from creating the blog post.
        $sql = "INSERT INTO table_blog_posts (web_site, web_site_2, category, image, stars, date, amazon_link, booktopia_link, title, description, blog_post) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        //Initalizes a statement to be used in the database.
        $stmt = mysqli_stmt_init($db);

        //Checks if the statement preparation was successful.
        if(mysqli_stmt_prepare($stmt, $sql)){

            //Binds the parameters to the statement.
            mysqli_stmt_bind_param($stmt, "ssssissssss", $web_site, $web_site_2, $category, $image, $stars, $date, $amazon_link, $booktopia_link, $title, $description, $blog_post);

            //Checks if the statement execute was successful.
            if(mysqli_stmt_execute($stmt)){

                //Redirects to the home page.
                header("Location: ../index.php");

            }else{

                //Displays an error message.
                die("Failed to execute statement: ".mysqli_stmt_error($stmt));
            }

        }else{

            //Displays an error message.
            die("Failed to prepare statement: ".mysqli_stmt_error($stmt));

        }

    }else{

        //Displays an error message.
        die("Invalid or missing parameters.");

    }

?>