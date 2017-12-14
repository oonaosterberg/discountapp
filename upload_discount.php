<?php
/**
 * Created by PhpStorm.
 * User: anukak
 * Date: 7.12.2017
 * Time: 13.10
 */
require_once ("includes/dbh.inc.php");
include_once 'header.php';
?>

<?php

            if (isset($_SESSION['u_ID'])) {

                include_once "includes/uploadform.php";

            } else {
                echo "You must be logged in to upload discounts!";
            };



?>

<?php

include_once 'footer.php';

?>
