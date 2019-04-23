<?php
	require "PHPMailer/_lib/class.phpmailer.php";
	require "Databaseconnect.php";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = $_POST["email"];
		$domain = substr($email, strpos($email, "@") + 1);
		if(checkdnsrr($domain)) {
			$q = "SELECT * FROM users WHERE email='$email'";
			$r = mysqli_query($dbc, $q);
			if(!$r) {
				die(mysqli_error($dbc));
			}
			while($row = mysqli_fetch_array($r)) {
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->Host = "smtp.gmail.com";
				$mail->SMTPAuth = true;
				$mail->Username = $row['username'];
				$mail->Password = $row['password'];
				$mail->SMTPSecure = "tls";
				$mail->Port = 587;
				$mail->setFrom("email@cmd.com", "Course Management Dashboard");
				$mail->addReplyTo("email@cmd.com", "Course Management Dashboard");
				$mail->addAddress($domain);
				$mail->isHTML = true;
				$mail->Subject = "Forgot Password";
				$mail->Body = "Username: ".$row['username']."\nPassword: ".$row['password'];
				if($mail->send()) {
					echo "<script>
						  window.alert('Username and password have been sent\nPlease check your email');
						  window.location.href = 'Login.php';
						  </script>";
				}
			}
		}
		else {
			echo "<script>
				  window.alert('Invalid email');
				  </script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Course Management Dashboard</title>
</head>
<style>
	body {
		font-family: Arial;
	}
	h1 {
		background-color: #bee9ed;
		padding: 30px;
		margin: auto;
		text-align: center;
	}
	h2 {
		text-align: center;
	}
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
		background-color: #333;
	}
	li {
		float: left;
		color: white;
		padding: 0 16px;
	}
	li a {
		display: block;
		color: white;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
	}
	li a:hover, li:nth-child(1) {
		background-color: #111;
	}
	div.form {
		text-align: center;
	}
	form {
		display: inline-block;
		text-align: left;
		background-color: lightgrey;
		padding: 12px 80px;
	}
	input {
		padding: 6px 10px;
		margin: 6px 0;
		border: 2px solid #50a150;
		border-radius: 4px;
	}
	input[type=button] {
		border: 2px solid grey;
		border-radius: 4px;
	}
</style>
<body>
	<h1>COURSE MANAGEMENT DASHBOARD</h1>
	<ul>
		<li><a>Forgot Password</a></li>
	</ul>
	<h2>FORGOT PASSWORD</h2>
	<div class="form">
		<form action="Forgotpassword.php" method="post">
			<b>Email</b><br>
			<input type="email" name="email" autocomplete="off" required>
			<br>
			<br>
			<input type="submit" value="Submit">
			<a href="Login.php"><input type="button" value="Cancel"></a>
		</form>
	</div>
</body>
</html>