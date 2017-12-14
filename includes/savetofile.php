<?php
/**
 * Created by PhpStorm.
 * User: Anu
 * Date: 5.12.2017
 * Time: 14.09
 */

include 'dbh.inc.php';

if (isset($_FILES['myFile'])) {


    if (isset($_SESSION['u_ID'])) {
        echo "Attempting to upload your files...";

        move_uploaded_file($_FILES['myFile']['tmp_name'], "./uploads/" . $_FILES['myFile']['name']);


        echo 'successful';

    } else {

        echo 'unsuccessful';

    }


}
?>