<?php
	session_start();
	require "Databaseconnect.php";
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = test_input($_POST["username"]);
		$password = test_input($_POST["password"]);
		$user_type = test_input($_POST["user_type"]);
		$vpassword = $vuser_type = false;
		$q1 = "SELECT username FROM users WHERE username='$username'";
		$r1 = mysqli_query($dbc, $q1);
		if(!$r1) {
			die(mysqli_error($dbc));
		}
		$q2 = "SELECT password FROM users WHERE username='$username'";
		$r2 = mysqli_query($dbc, $q2);
		if(!$r2) {
			die(mysqli_error($dbc));
		}
		while($row = mysqli_fetch_array($r2)) {
			if($row['password'] == $password) {
				$vpassword = true;
			}
		}
		$q3 = "SELECT user_type FROM users WHERE username='$username'";
		$r3 = mysqli_query($dbc, $q3);
		if(!$r3) {
			die(mysqli_error($dbc));
		}
		while($row = mysqli_fetch_array($r3)) {
			if($row['user_type'] == $user_type) {
				$vuser_type = true;
			}
		}
		if(mysqli_num_rows($r1) > 0 && $vpassword && $vuser_type) {
			$_SESSION["username"] = $username;
			$_SESSION["user_type"] = $user_type;
			echo "<script>
				  window.location.href = 'Personalinfo.php';
				  </script>";
		}
		else {
			echo "<script>
				  window.alert('Username and password do not match');
				  window.history.back();
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
	}
	li a {
		display: block;
		color: white;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
	}
	li a:hover {
		background-color: #111;
	}
	div.li1, div.li2, div.li3, div.li4 {
		float: right;
		position: relative;
		color: white;
		padding: 0 16px;
	}
	div.li1 {
		left: -500px;
	}
	div.li2 {
		left: -100px;
	}
	div.li3 {
		left: 320px;
	}
	div.li4 {
		left: 620px;
	}
	input, select {
		padding: 6px 10px;
		margin: 6px 0;
		border: 2px solid #50a150;
		border-radius: 4px;
	}
	input[type=submit] {
		background-color: #50a150;
		color: white;
	}
</style>
<body>
	<h1>COURSE MANAGEMENT DASHBOARD</h1>
	<form action="Login.php" method="post">
		<ul>
			<li><a href="Forgotpassword.php">Forgot Password</a></li>
			<div class="li1"><li>Log in as <select name="user_type"><option value="admin">Admin</option><option value="student">Student</option></select></li></div>
			<div class="li2"><li><input type="text" name="username" placeholder="Username" autocomplete="off" required></li></div>
			<div class="li3"><li><input type="password" name="password" placeholder="Password" autocomplete="off" required></li></div>
			<div class="li4"><li><input type="submit" value="Log in"></li></div>
		</ul>
	</form>
	<iframe src="https://uumportal.uum.edu.my" frameborder="0" style="width:100%; height:560px; overflow-x:hidden; overflow-y:hidden"></iframe>
</body>
</html>