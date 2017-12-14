<?php
require_once ("includes/dbh.inc.php");
session_start();

if (empty($_SESSION['save'])) {
    $_SESSION['save'] = array();
}

array_push($_SESSION['save'], $_GET['ID']);

?>

<p>
    Discount successfully saved to your profile page!
</p>