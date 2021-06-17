<?php

    //Requires the config file information.
    require $_SERVER["DOCUMENT_ROOT"]."/config.php";

    //Attempts to connect to the database.
    $db = mysqli_connect($db_address, $db_username, $db_password, $db_name, $db_port);

    //Checks if the database connection failed.
    if(!$db){
        die("Connection failed: ".mysqli_connect_error());
    }

?>