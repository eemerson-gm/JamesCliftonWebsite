
<!-- Includes the header onto the page. -->
<?php include("templates/header.php"); ?>

<?php

    //Includes the post select functions.
    include("posts/select.php");

?>

<div class="main">
    <div class="post_holder">
        <div class="post">
            <h1 class="post_title">Links</h1>
            <ul style="list-style:none">
                <?php

                    //Gets all the links from the link table.
                    $results = posts_select_links();

                    //Loops through the results from the database.
                    while($row = $results->fetch_assoc()){

                        //Prints out the link information.
                        echo    "
                                <li>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a class='link' href='".$row["url"]."'>
                                                        ".$row["name"]."
                                                    </a>
                                                </td>
                                                <td>
                                                    <h3 class='link_description'>
                                                        ".$row["description"]."
                                                    </h3>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </li>
                                ";

                    }

                ?> 
            </ul>
        </div>
    </div>
</div>

<!-- Includes the sidebar onto the page. -->
<?php include("templates/sidebar.php"); ?>

<!-- Includes the footer onto the page. -->
<?php include("templates/footer.php"); ?>