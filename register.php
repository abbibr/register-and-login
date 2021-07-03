<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="signup.php" method="post">
		<h2>Sign Up</h2>

		<?php if(isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>

		<?php if(isset($_GET['success'])) { ?>
			<p class="success"><?php echo $_GET['success']; ?></p>
		<?php } ?>
		
		<label>Name</label>
		<input type="text" name="name" placeholder="Name"><br>
		<label>Email</label>
		<input type="text" name="email" placeholder="Email"><br>
		<label>Password</label>
		<input type="password" name="password" placeholder="Password"><br>
		<label>Confirm Password</label>
		<input type="password" name="cpassword" placeholder="Confirm Password"><br>
		<button type="submit" name="submit">Sign Up</button>
		<a href="index.php" class="ca">Already have an account?</a>
	</form>
</body>
</html>