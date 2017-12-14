<?php
require_once 'dbh.inc.php';
if (isset($_POST['submit'])) {
	session_start();
	$muuttuja = $_SESSION['u_ID'];
    $sql = "UPDATE log SET Logout=now() WHERE User_id='$muuttuja';";
    mysqli_query($conn, $sql);
	session_unset();
    session_destroy();
	header("Location: ../index.php");
	exit();
}