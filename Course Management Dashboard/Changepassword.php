<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$matric = $_SESSION['matric'];
	$picture = $_SESSION['picture'];
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$password = test_input($_POST["password"]);
		$npassword = test_input($_POST["npassword"]);
		$q1 = "SELECT * FROM users WHERE matric='$matric'";
		$r1 = mysqli_query($dbc, $q1);
		$row1 = mysqli_fetch_array($r1);
		$cpassword = $row1['password'];
		if($cpassword == $password) {
			$q2 = "UPDATE users SET password='$npassword' WHERE matric='$matric'";
			$r2 = mysqli_query($dbc, $q2);
			if($r2) {
				echo "<script>
					  window.alert('Successfully changed password');
					  window.location.href = 'Personalinfo.php';
					  </script>";
			}
			else {
				die(mysqli_error($dbc));
			}
		}
		else {
			echo "<script>
				  window.alert('Incorrect current password');
				  
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
	li:nth-child(6) {
		display: block;
		color: lime;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
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
	img {
		border-radius: 50%;
	}
	button {
		background: none;
		color: inherit;
		border: none;
		padding: 0;
		font: inherit;
		cursor: pointer;
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
		border: 2px solid #1f455e;
		border-radius: 4px;
	}
	input[type=submit] {
		background-color: #1f455e;
		color: white;
	}
	input[type=button] {
		border: 2px solid grey;
		border-radius: 4px;
	}
</style>
<body>
	<h1>COURSE MANAGEMENT DASHBOARD</h1>
	<ul>
		<li><a href="Personalinfo.php">Personal Info</a></li>
		<li><a href="Dashboard.php">Dashboard</a></li>
		<li><?php if($_SESSION['user_type'] == "student") { ?>
			<a href="Courseadvisor.php">Course Advisor</a>
		<?php } ?></li>
		<li><?php if($_SESSION['user_type'] == "admin") { ?>
			<a href="Studentinfo.php">Student Info</a>
		<?php } ?></li>
		<li style="float:right"><a href="Logout.php">Logout</a></li>
		<li style="float:right"><?php if($picture != "") {echo "<img src='".$picture."' height='15' width='15'> ".$username." ".$matric;}else {echo "<img src='https://www.freeiconspng.com/uploads/profile-icon-9.png' alt='' width='15' height='15'> ".$username." ".$matric;} ?></li>
	</ul>
	<p style="color:blue; border-bottom-style:solid">Personal Info > Change Password<button onclick=back() style="float:right">Back</button></p>
	<h2>CHANGE PASSWORD</h2>
	<div class="form">
		<form action="Changepassword.php" method="post" onsubmit="return test_password(this)">
			<b>Current Password</b><br>
			<input type="password" name="password" id="password" autocomplete="off" required>
			<br>
			<br>
			<b>New Password</b><br>
			<input type="password" name="npassword" id="npassword" autocomplete="off" required>
			<br>
			<br>
			<b>Confirm Password</b><br>
			<input type="password" name="cpassword" id="cpassword" autocomplete="off" required>
			<br>
			<br>
			<input type="submit" value="Set new password">
			<a href="Personalinfo.php"><input type="button" value="Cancel"></a>
		</form>
	</div>
<script>
	function back() {
		window.history.back();
	}
	function test_password(scope) {
		var npassword = document.getElementById("npassword").value;
		var cpassword = document.getElementById("cpassword").value;
		if(npassword != cpassword) {
			window.alert("Password and confirm password do not match");
			document.getElementById("npassword").value = "";
			document.getElementById("cpassword").value = "";
			console.log(scope);
			return false;
		}
	}
</script>
</body>
</html>