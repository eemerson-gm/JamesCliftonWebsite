<?php

    //Selects the most recent posts for the specified website.
    function posts_select_recent($web_site, $number){

        //Requires the database to create the blog posts.
        require $_SERVER["DOCUMENT_ROOT"]."/posts/database.php";

        //Gets the insert sql statement from creating the blog post.
        $sql = "SELECT * FROM table_blog_posts WHERE web_site = ? ORDER BY date DESC LIMIT ?;";

        //Initalizes a statement to be used in the database.
        $stmt = mysqli_stmt_init($db);

        //Prepates the statement.
        if(!mysqli_stmt_prepare($stmt, $sql)){
            die(mysqli_stmt_error($stmt));
        }

        //Binds the parameters to the statement.
        mysqli_stmt_bind_param($stmt, "si", $web_site, $number);

        //Executes the statement on the database.
        if(!mysqli_stmt_execute($stmt)){
            die(mysqli_stmt_error($stmt));
        }

        //Gets the result of the statement.
        $results = mysqli_stmt_get_result($stmt);

        //Returns the results.
        return $results;

    }

    //Selects all of the blog posts sorted by date.
    function posts_select_all(){

        //Requires the database to create the blog posts.
        require $_SERVER["DOCUMENT_ROOT"]."/posts/database.php";

        //Gets the insert sql statement from creating the blog post.
        $sql = "SELECT * FROM table_blog_posts ORDER BY date DESC;";

        //Initalizes a statement to be used in the database.
        $stmt = mysqli_stmt_init($db);

        //Prepates the statement.
        if(!mysqli_stmt_prepare($stmt, $sql)){
            die(mysqli_stmt_error($stmt));
        }

        //Executes the statement on the database.
        if(!mysqli_stmt_execute($stmt)){
            die(mysqli_stmt_error($stmt));
        }

        //Gets the result of the statement.
        $results = mysqli_stmt_get_result($stmt);

        //Returns the results.
        return $results;

    }

    //SCounts all the posts within the month of the year.
    function posts_count_archives($web_site){

        //Requires the database to create the blog posts.
        require $_SERVER["DOCUMENT_ROOT"]."/posts/database.php";

        //Gets the insert sql statement from creating the blog post.
        $sql = "SELECT date, count(date) AS number FROM table_blog_posts WHERE web_site = ? GROUP BY YEAR(date), MONTH(date);";

        //Initalizes a statement to be used in the database.
        $stmt = mysqli_stmt_init($db);

        //Prepates the statement.
        if(!mysqli_stmt_prepare($stmt, $sql)){
            die(mysqli_stmt_error($stmt));
        }

        //Binds the parameters to the statement.
        mysqli_stmt_bind_param($stmt, "s", $web_site);

        //Executes the statement on the database.
        if(!mysqli_stmt_execute($stmt)){
            die(mysqli_stmt_error($stmt));
        }

        //Gets the result of the statement.
        $results = mysqli_stmt_get_result($stmt);

        //Returns the results.
        return $results;

    }

    //Counts all the posts in a specific category.
    function posts_count_categories($web_site){

        //Requires the database to create the blog posts.
        require $_SERVER["DOCUMENT_ROOT"]."/posts/database.php";

        //Gets the insert sql statement from creating the blog post.
        $sql = "SELECT category, count(category) AS number FROM table_blog_posts WHERE web_site = ? GROUP BY category;";

        //Initalizes a statement to be used in the database.
        $stmt = mysqli_stmt_init($db);

        //Prepates the statement.
        if(!mysqli_stmt_prepare($stmt, $sql)){
            die(mysqli_stmt_error($stmt));
        }

        //Binds the parameters to the statement.
        mysqli_stmt_bind_param($stmt, "s", $web_site);

        //Executes the statement on the database.
        if(!mysqli_stmt_execute($stmt)){
            die(mysqli_stmt_error($stmt));
        }

        //Gets the result of the statement.
        $results = mysqli_stmt_get_result($stmt);

        //Returns the results.
        return $results;

    }

    //Selects a post by blog post id.
    function posts_select_id($id){

        //Requires the database to create the blog posts.
        require $_SERVER["DOCUMENT_ROOT"]."/posts/database.php";

        //Gets the insert sql statement from creating the blog post.
        $sql = "SELECT * FROM table_blog_posts WHERE blog_id = ?;";

        //Initalizes a statement to be used in the database.
        $stmt = mysqli_stmt_init($db);

        //Prepates the statement.
        if(!mysqli_stmt_prepare($stmt, $sql)){
            die(mysqli_stmt_error($stmt));
        }

        //Binds the parameters to the statement.
        mysqli_stmt_bind_param($stmt, "i", $id);

        //Executes the statement on the database.
        if(!mysqli_stmt_execute($stmt)){
            die(mysqli_stmt_error($stmt));
        }

        //Gets the result of the statement.
        $results = mysqli_stmt_get_result($stmt);

        //Returns the results.
        return $results;

    }

    //Selects the most recent posts for the specified website.
    function posts_select_category($web_site, $category){

        //Requires the database to create the blog posts.
        require $_SERVER["DOCUMENT_ROOT"]."/posts/database.php";

        //Gets the insert sql statement from creating the blog post.
        $sql = "SELECT * FROM table_blog_posts WHERE web_site = ? AND category = ? ORDER BY date DESC;";

        //Initalizes a statement to be used in the database.
        $stmt = mysqli_stmt_init($db);

        //Prepates the statement.
        if(!mysqli_stmt_prepare($stmt, $sql)){
            die(mysqli_stmt_error($stmt));
        }

        //Binds the parameters to the statement.
        mysqli_stmt_bind_param($stmt, "ss", $web_site, $category);

        //Executes the statement on the database.
        if(!mysqli_stmt_execute($stmt)){
            die(mysqli_stmt_error($stmt));
        }

        //Gets the result of the statement.
        $results = mysqli_stmt_get_result($stmt);

        //Returns the results.
        return $results;

    }

    //Selects all the posts with the specified date.
    function posts_select_archive($web_site, $date){

        //Requires the database to create the blog posts.
        require $_SERVER["DOCUMENT_ROOT"]."/posts/database.php";

        //Gets the insert sql statement from creating the blog post.
        $sql = "SELECT * FROM table_blog_posts WHERE web_site = ? AND YEAR(date) = ? AND MONTH(date) = ? ORDER BY date DESC;";

        //Initalizes a statement to be used in the database.
        $stmt = mysqli_stmt_init($db);

        //Prepates the statement.
        if(!mysqli_stmt_prepare($stmt, $sql)){
            die(mysqli_stmt_error($stmt));
        }

        //Binds the parameters to the statement.
        mysqli_stmt_bind_param($stmt, "sss", $web_site, date("Y", $date), date("m", $date));

        //Executes the statement on the database.
        if(!mysqli_stmt_execute($stmt)){
            die(mysqli_stmt_error($stmt));
        }

        //Gets the result of the statement.
        $results = mysqli_stmt_get_result($stmt);

        //Returns the results.
        return $results;

    }

    //Selects all links from the database.
    function posts_select_links(){

        //Requires the database to create the blog posts.
        require $_SERVER["DOCUMENT_ROOT"]."/posts/database.php";

        //Gets the insert sql statement from creating the blog post.
        $sql = "SELECT * FROM table_link;";

        //Initalizes a statement to be used in the database.
        $stmt = mysqli_stmt_init($db);

        //Prepates the statement.
        if(!mysqli_stmt_prepare($stmt, $sql)){
            die(mysqli_stmt_error($stmt));
        }

        //Executes the statement on the database.
        if(!mysqli_stmt_execute($stmt)){
            die(mysqli_stmt_error($stmt));
        }

        //Gets the result of the statement.
        $results = mysqli_stmt_get_result($stmt);

        //Returns the results.
        return $results;

    }
    
?>