
<!-- Webpage title. -->
<title>Admin</title>

<!-- Includes the header onto the page. -->
<?php include("templates/header.php"); ?>

<?php

    //Requires the config file information.
    require "config.php";

    //Gets the postback password to login as admin.
    $login_password = $_POST["password"];

    //Checks if the login password has been set.
    if(isset($login_password)){

        //Checks if the admin and login password are equal.
        if($admin_password == $login_password){

            //Displays the blog post creation page.
            include("templates/blogpost.php");

        }else{

            //Displays the login page for administrator.
            include("templates/login.php");

        }

    }else{

        //Displays the login page for administrator.
        include("templates/login.php");

    }
?>

<!-- Includes the footer onto the page. -->
<?php include("templates/footer.php"); ?>