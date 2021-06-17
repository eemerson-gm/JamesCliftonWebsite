
<div class="sidebar">

    <!-- Sidebar recent posts. -->
    <h2 class="sidebar_title">
        Recent Posts
    </h2>
    <hr>
    <ul class="sidebar_list">
        <?php

            //Selects all posts to list on the sidebar.
            $results_list = posts_select_recent("james_clifton", 10);

            //Loops through each entry.
            while($row = $results_list->fetch_assoc()){

                //Prints out the recent posts into the list.
                echo    "<a href='/index.php?id=".$row["blog_id"]."'>
                            <li class='sidebar_item noselect'>
                                ".$row["title"]."
                            </li>
                        </a>
                        ";
            }

        ?>
    </ul>
    <br>

    <!-- Sidebar archives. -->
    <h2 class="sidebar_title">
        Archives
    </h2>
    <hr>
    <form action="index.php">
        <select class="sidebar_dropdown" name="archive" onchange="this.form.submit();">
            <option disabled selected>Select Month/Year</option>
            <?php

                //Selects all posts to list on the sidebar.
                $results_list = posts_count_archives("james_clifton");

                //Loops through each entry.
                while($row = $results_list->fetch_assoc()){

                    //Formats the date time.
                    $time = strtotime($row["date"]);
                    $date = date("F Y", $time);
                    $value = date("Y-m", $time);

                    //Prints out the recent posts into the list.
                    echo "<option value='".$value."'>".$date." (".$row["number"].")"."</option>";

                }

            ?>
        </select>
    </form>
    <br>

    <!-- Sidebar categories. -->
    <h2 class="sidebar_title">
        Categories
    </h2>
    <hr>
    <form action="index.php">
        <select class="sidebar_dropdown" name="category" oninput="this.form.submit();">
            <option disabled selected>Select Category</option>
            <?php

                //Selects all posts to list on the sidebar.
                $results_list = posts_count_categories("james_clifton");

                //Loops through each entry.
                while($row = $results_list->fetch_assoc()){

                    //Prints out the recent posts into the list.
                    echo "<option value='".$row["category"]."'>".$row["category"]." (".$row["number"].")"."</option>";

                }

            ?>
        </select>
    </form>
</div>