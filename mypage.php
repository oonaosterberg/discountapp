<link rel="stylesheet" href="style.css">

<?php
include_once 'header.php';
require_once ("includes/dbh.inc.php");
session_start();

?>


    <section class="main-container">
        <div class="main-wrapper">

            <?php
            //näytä käyttäjän tiedot
            if (isset($_SESSION['u_ID'])) {

                $ID = mysqli_real_escape_string($conn, $_GET['ID']);
                $sql = "SELECT * FROM userdata WHERE ID = '$ID'";
                $result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");
                $row = mysqli_fetch_array($result);

                echo '
            <br>
            <h2>' . $row['Username'] . '</h2>
            <p>' . $row['Firstname'] . '</p>
            <p>' . $row['City'] . '</p>
            <p><b>Member since: </b>' . $row['Created'] . '</p>>
            <br> 
            <h2>Your shopping list: </h2>';

                //Hae tallennetut alennukset

            $whereIn = implode(', ', $_SESSION['save']);

            $sql = "SELECT * FROM discount 
                    WHERE ID IN ($whereIn)";

            $result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");

            while ($row = mysqli_fetch_array($result)) {
                $img = ($row['Img_url']);
                $getid = ($row['ID']);
                $expire = ($row['Expiration_time']);
                $time = time();

                //if ($time < $expire) {
                echo '<a href="imgpage.php?ID=' . $getid . '"><img class = "gallery" src="'.$img.'"/> </a>';
            }



            } else {
                header("Location: index.php");
            }

            ?>


        </div>


    </section>



<?php
include_once 'footer.php';
?>