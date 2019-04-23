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
		$matric = test_input($_POST["matric"]);
		$username = test_input($_POST["username"]);
		$ic = test_input($_POST["ic"]);
		$email = test_input($_POST["email"]);
		$programme = test_input($_POST["programme"]);
		$total_credit = "";
		$q1 = "SELECT matric FROM users WHERE matric='$matric'";
		$r1 = mysqli_query($dbc, $q1);
		if(!$r1) {
			die(mysqli_error($dbc));
		}
		if(mysqli_num_rows($r1) > 0) {
			echo "<script>
				  window.alert('Matric number has been used');
				  window.history.back();
				  </script>";
		}
		$q2 = "SELECT username FROM users WHERE username='$username'";
		$r2 = mysqli_query($dbc, $q2);
		if(!$r2) {
			die(mysqli_error($dbc));
		}
		if(mysqli_num_rows($r2) > 0) {
			echo "<script>
				  window.alert('Username has been used');
				  window.history.back();
				  </script>";
		}
		switch($programme) {
			case "Information Technology":
				$total_credit = 132;
				break;
			case "Business Administration":
				$total_credit = 129;
				break;
		}
		$q3 = "INSERT INTO users VALUES ('$matric', '$username', '$ic', '$ic', '$email', '', '$programme', '$total_credit', '', 'student')";
		$r3 = mysqli_query($dbc, $q3);
		if($r3) {
			echo "<script>
				  window.alert('Successfully added new student');
				  window.location.href = 'Studentinfo.php';
				  </script>";
		}
		else {
			die(mysqli_error($dbc));
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
	li:nth-child(5) {
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
	li a:hover, li:nth-child(3) {
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
	form {
		width: 35%;
		margin: 0 auto;
	}
	table {
		border-collapse: collapse;
		width: 100%;
	}
	td, th {
		border: 1px solid #ddd;
		padding: 8px;
	}
	tr {
		background-color: #f2f2f2;
	}
	tr:hover {
		background-color: #ddd;
	}
	th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #1f455e;
		color: white;
	}
	input, select {
		padding: 6px 10px;
		margin: 8px 0;
		border: 2px solid #1f455e;
		border-radius: 4px;
	}
	input[type=submit] {
		background-color: #1f455e;
		color: white;
	}
	input[type=reset] {
		border: 2px solid lightgrey;
		border-radius: 4px;
	}
</style>
<body>
	<h1>COURSE MANAGEMENT DASHBOARD</h1>
	<ul>
		<li><a href="Personalinfo.php">Personal Info</a></li>
		<li><a href="Dashboard.php">Dashboard</a></li>
		<li><a href="Studentinfo.php">Student Info</a></li>
		<li style="float:right"><a href="Logout.php">Logout</a></li>
		<li style="float:right"><?php if($picture != "") {echo "<img src='".$picture."' height='15' width='15'> ".$username." ".$matric;}else {echo "<img src='https://www.freeiconspng.com/uploads/profile-icon-9.png' alt='' width='15' height='15'> ".$username." ".$matric;} ?></li>
	</ul>
	<p style="color:blue; border-bottom-style:solid">Student Info > Register Student<button onclick=back() style="float:right">Back</button></p>
	<h2>REGISTER STUDENT</h2>
	<form action="Registerstudent.php" method="post">
		<table>
			<tr>
				<th>Matric No</th>
				<td><input type="number" name="matric" oninput="javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6" required></td>
			</tr>
			<tr>
				<th>Student Name</th>
				<td><input type="text" name="username" autocomplete="off" required></td>
			</tr>
			<tr>
				<th>IC No</th>
				<td><input type="number" name="ic" oninput="javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" required></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><input type="email" name="email" autocomplete="off" required></td>
			</tr>
			<tr>
				<th>Programme</th>
				<td><select name="programme"><option value="Information Technology">Information Technology</option><option value="Business Administration">Business Administration</option></select></td>
			</tr>
		</table>
		<input type="submit" value="Register new student">
		<input type="reset" value="Cancel">
	</form>
<script>
	function back() {
		window.history.back();
	}
</script>
</body>
</html>