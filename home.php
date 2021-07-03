<?php
	
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['email']))
{

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Hello, <?php echo $_SESSION['name']; ?></h1>
	<a href="logout.php" class="logout">Logout</a>
</body>
</html>

<?php

}else
{
	header("Location: index.php");
}

?>