<?php
// TÄNNE HAKUTOIMINTO
include_once 'dbh.inc.php';

if (isset ($_POST['button']) && (!empty($_POST['search']))) {


    $search = $_POST['search'];
    $sql="SELECT * FROM mm_media WHERE mediaUrl LIKE " . "'%".$search."%'";
    $result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");
    echo("</br>");
    $searchform = $DBH->prepare($sql);
    $searchform -> execute();
    try{
        while ($row = $searchform->fetch()) {
            //echo $row["mediaID"] . "<br />";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $img = ($row['mediaUrl']);
                    $getid = ($row["mediaID"]);
                    $expire = ($row["mediaDate"]);
                    $time = time();

                    //if ($time < $expire) {
                    echo '<a href="imgpage.php?ID=' . $getid . '"><img class = "gallery" src="img/original/' . $img . '"/> </a>';
                    // }
                }
            } else {
                echo"<h2>No discounts to display</h2>";
            }
        }
    } catch (PDOException $e) {
        die("error: " . $e->getMessage());
    }
}
?>