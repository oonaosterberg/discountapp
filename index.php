<?php
require_once ("includes/dbh.inc.php");
include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Home</h2>
        <?php
        if (isset($_SESSION['u_ID'])) {
            echo "You are logged in!";
        }
        ?>

        <p></p>

        <div class = "search">
            <form method = "post">
                <label>Search:
                    <input type="text" name="search" placeholder = "Search">
                    <button type="submit" name="button">Apply</button>
                </label>
            </form>
        </div>



            <div class ="container">
                <?php


                // hakee tuotteet discount-tablesta


                if (empty($_POST['search'])) {
                    $sql = "SELECT * FROM discount";
                    $result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");

                    while ($row = mysqli_fetch_array($result)) {
                        $img = ($row['Img_url']);
                        $getid = ($row['ID']);
                        $expire = ($row['Expiration_time']);
                        $time = time();

                        //if ($time < $expire) {
                        echo '<a href="imgpage.php?ID=' . $getid . '"><img class = "gallery" src="'.$img.'"/> </a>';
                        }
                        //}
                   // }

                } else if (isset ($_POST['button']) && (!empty($_POST['search']))) {

                //hakulomake

                $search = $_POST['search'];
                $sql="SELECT * FROM discount WHERE Discount_name LIKE " . "'%".$search."%'";
                $result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");


                $searchform = $DBH->prepare($sql);
                $searchform -> execute();
                    while ($row = $searchform->fetch()) {
                            while ($row = mysqli_fetch_array($result)) {
                                $img = ($row['Img_url']);
                                $getid = ($row['ID']);
                                $expire = ($row['Expiration_time']);
                                $time = time();

                                //if ($time < $expire) {
                                echo '<a href="imgpage.php?ID=' . $getid . '"><img class = "gallery" src="'.$img.'"/> </a>';
                                //}
                            }
                       // }
                    }
                }

                ?>
            </div>
    </div>
</section>