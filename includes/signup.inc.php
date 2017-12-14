<?php

if (isset($_POST['submit'])) {

	include_once 'dbh.inc.php';

	$Email = mysqli_real_escape_string($conn, $_POST['Email']);
	$Username = mysqli_real_escape_string($conn, $_POST['Username']);
	$Pswd = mysqli_real_escape_string($conn, $_POST['Pswd']);

	//error handlers
	// check for empty fields
	if (empty($Email) || empty($Username) || empty($Pswd)) {
		header("Location: ../signup.php?signup=empty");
		exit();
	} else {
/*		// check if input character are valid
		if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
			header("Location: ../signup.php?signup=invalid");
			exit();
		} else {*/
			// check if email is valid
			if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../signup.php?signup=email");
				exit();
			} else {
				$sql = "SELECT * FROM userdata WHERE Username='$Username'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0) {
					header("Location: ../signup.php?signup=usertaken");
					exit();
				} else {
					//hashing the password
					$hashedPwd = password_hash($Pswd, PASSWORD_DEFAULT);
					//insert the user into the database
					$sql = "INSERT INTO userdata (Email, Username, Pswd) VALUES ('$Email', '$Username', '$hashedPwd');";
                    mysqli_query($conn, $sql);
				    header("Location: ../signup.php?signup=success");
				exit();
				}
			}
		}


} else {
	header("Location: ../signup.php");
	exit();
}
?>