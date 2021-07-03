<?php

session_start();

include_once "db.conn.php";

if(isset($_POST['submit']))
{
	if(isset($_POST['email']) && isset($_POST['password']))
	{
		function validate($data)
		{
			$data=trim($data);
			$data=stripcslashes($data);
			$data=htmlspecialchars($data);
			return $data;
		}

		$email=validate($_POST['email']);
		$pass=validate($_POST['password']);
		$new_pass=md5($pass);

		if(empty($email))
		{
			header("Location: index.php?error=Email is required!");
		}
		elseif (empty($pass)) 
		{
			header("Location: index.php?error=Password is required!");
		}
		else
		{
			$sql="SELECT * FROM users WHERE email='$email'
			AND password='$new_pass'";
			$result=$conn->query($sql);

			if($result->num_rows === 1)
			{
				$row=$result->fetch_assoc();

				if($row['email'] === $email && $row['password'] === $new_pass)
				{
					$_SESSION['email']=$row['email'];
					$_SESSION['name']=$row['name'];
					$_SESSION['id']=$row['id'];

					header("Location: home.php");
				}
			}
			else
			{
				header("Location: index.php?error=Incorrect email or Password");
			}
		}
	}
	else
	{
		header("Location: index.php?error");
	}
}

?>