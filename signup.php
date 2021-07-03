<?php

session_start();

include_once "db.conn.php";

	if(isset($_POST['name']) && isset($_POST['email']) &&
	isset($_POST['password']) && isset($_POST['cpassword']))
	{
		function validate($data)
		{
			$data=trim($data);
			$data=stripcslashes($data);
			$data=htmlspecialchars($data);
			return $data;
		}

		$name=validate($_POST['name']);
		$email=validate($_POST['email']);
		$pass=validate($_POST['password']);
		$cpass=validate($_POST['cpassword']);

		# $user_data='Name: '.$name.' & Email: '.$email;
		$pattern_password="/^[a-z0-9]{5,}$/";
		$new_pass=md5($pass);
	
		if(empty($name))
		{
			header("Location: register.php?error=Name is required!");
		}
		elseif (empty($email)) 
		{
			header("Location: register.php?error=Email is required!");
		}
		elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) 
		{
			header("Location: register.php?error=This email is not valid!");
		}
		elseif (empty($pass)) 
		{
			header("Location: register.php?error=Password is required!");
		}
		elseif (!preg_match($pattern_password, $pass)) 
		{
			header("Location: register.php?error=Password must be minimum 5 character!");
		}
		elseif (empty($cpass)) 
		{
			header("Location: register.php?error=Confirm Password is required!");
		}
		elseif ($pass !== $cpass) 
		{
			header("Location: register.php?error=Confirmation Password does not match!");
		}
		else
		{
			$sql="SELECT * FROM users WHERE email='$email'";
			$result=$conn->query($sql);

			if($result->num_rows > 0)
			{
				/* $row=$result->fetch_assoc();

				if($row['email'] === $email && $row['password'] === $pass)
				{
					$_SESSION['email']=$row['email'];
					$_SESSION['name']=$row['name'];
					$_SESSION['id']=$row['id'];

					header("Location: home.php");
				} */
				header("Location: register.php?error=This email already has been taken!");
			} 
			else
			{
				$sql2=$conn->prepare("INSERT INTO users(id,email,password,name) VALUES(NULL,?,?,?)");
				$sql2->bind_param("sss",$email,$new_pass,$name);
				$sql2->execute();
				$sql2->close();

				header("Location: register.php?success=Your account saved!");
			}
		}
	}
	else
	{
		header("Location: register.php?error");
	}

?>