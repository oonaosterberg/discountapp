<?php
    require_once ("includes/dbh.inc.php");
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
	<nav>
		<div class="main-wrapper">
			<ul>
				<li><a href="index.php">Home</a></li>
			</ul>
            <ul>
                <li><a href="upload_discount.php">Upload</a></li>
            </ul>

            <?php
            if (isset($_SESSION['u_ID'])) {
                $sql = "SELECT * FROM userdata";
                $result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");
                $getid = ($_SESSION['u_ID']);

                echo '<ul>
                    <li><a href="mypage.php?ID=' . $getid . '">My Page</a></li>
                  </ul>';

            }
            ?>

			<div class="nav-login">
				<?php
					if (isset($_SESSION['u_ID'])) {

						echo '<form action="includes/logout.inc.php" method="POST">
							    <button type="submit" name="submit">Logout</button>
						      </form>
						      ';
					} else {
						echo '<form action="includes/login.inc.php" method="POST">
							<input type="text" name="Username" placeholder="Username/Email">
							<input type="password" name="Pswd" placeholder="password">
							<button type="submit" name="submit">Login</button>
						</form>
						<a href="signup.php">Sign up</a>';
					}
				?>
			</div>
		</div>
	</nav>
</header>