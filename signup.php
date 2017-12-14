<?php
require_once ("includes/dbh.inc.php");
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>Signup</h2>
		<form class="signup-form" action="includes/signup.inc.php" method="POST">
			<input type="text" name="Email" placeholder="Email">
			<input type="text" name="Username" placeholder="Username">
			<input type="password" name="Pswd" placeholder="Password">
			<button type="submit" name="submit">Sign up</button>
		</form>
	</div>
</section>

<?php
	include_once 'footer.php';
?>