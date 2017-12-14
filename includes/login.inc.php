<?php

session_start();

if (isset($_POST['submit'])) {

	include 'dbh.inc.php';

	$Username = mysqli_real_escape_string($conn, $_POST['Username']);
	$Pswd = mysqli_real_escape_string($conn, $_POST['Pswd']);

	//error handlers
	// check if inputs are empty
	if (empty($Username) || empty($Pswd)) {
		header("Location: ../index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM userdata WHERE Username='$Username' OR Email='$Username'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../index.php?login=error1");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				//De-hashing the password
                //print_r($row);
				$hashedPwdCheck = password_verify($Pswd, $row['Pswd']);
				echo $hashedPwdCheck;
				if (!$hashedPwdCheck) {
					header("Location: ../index.php?login=error2");
					exit();
				} elseif ($hashedPwdCheck == true) {
					//log in the user here
					$_SESSION['u_ID'] = $row['ID'];
					$_SESSION['u_Email'] = $row['Email'];
					$_SESSION['u_Username'] = $row['Username'];
					$muuttuja = $_SESSION['u_ID'];
                    $sql = "INSERT INTO log(User_id, Login) SELECT $muuttuja, now() FROM userdata  LIMIT 1;";
					mysqli_query($conn, $sql);
					header("Location: ../index.php?login=success");
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../index.php?login=error3");
	exit();
}
?>