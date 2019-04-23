<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$matric = $_SESSION['matric'];
	$picture = $_SESSION['picture'];
	$q1 = "SELECT * FROM users where matric='$matric'";
	$r1 = mysqli_query($dbc, $q1);
	$row1 = mysqli_fetch_array($r1);
	$q2 = "SELECT * FROM dashboard where matric='$matric'";
	$r2 = mysqli_query($dbc, $q2);
	$q3 = "SELECT SUM(credit_hour) AS credit_taken FROM dashboard where matric='$matric'";
	$credit_taken = mysqli_query($dbc, $q3);
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
	form {
		width: 60%;
		margin: 0 auto;
	}
	table {
		border-collapse: collapse;
		width: 100%;
	}
	td {
		text-align: center;
	}
	a input, input {
		font-size: 20px;
		width: 800px;
		height: 50px;
	}
	a input {
		padding: 6px 10px;
		margin: 8px 0;
		border: 2px solid #6a5acd;
		background-color: #6a5acd;
		color: white;
	}
	a input:hover {
		padding: 6px 10px;
		margin: 8px 0;
		border: 2px solid #8470ff;
		background-color: #8470ff;
		color: white;
	}
	input {
		padding: 6px 10px;
		margin: 8px 0;
		border: 2px solid #483d8b;
		background-color: #483d8b;
		color: lightgrey;
	}
</style>
<body>
	<h1>COURSE MANAGEMENT DASHBOARD</h1>
	<ul>
		<li><a href="Personalinfo.php">Personal Info</a></li>
		<li><a href="Dashboard.php">Dashboard</a></li>
		<li><a>Course Advisor</a></li>
		<li style="float:right"><a href="Logout.php">Logout</a></li>
		<li style="float:right"><?php if($picture != "") {echo "<img src='".$picture."' height='15' width='15'> ".$username." ".$matric;}else {echo "<img src='https://www.freeiconspng.com/uploads/profile-icon-9.png' alt='' width='15' height='15'> ".$username." ".$matric;} ?></li>
	</ul>
	<h2>COURSE ADVISOR</h2>
	<form>
		<table>
			<tr>
			<?php if(mysqli_num_rows($r2) > 0 && $row1['total_credit'] - $credit_taken > 3) { ?>
				<td><a href="Nextsemadvisor.php"><input type="button" value="Courses next semester"></a></td>
			<?php }else { ?>
				<td><input type="button" value="Courses next semester"></td>
			<?php } ?>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
			<?php if($row1['major'] == "") { ?>
				<td><a href="Majoradvisor.php"><input type="button" value="Major"></a></td>
			<?php }else { ?>
				<td><input type="button" value="Major"></td>
			<?php } ?>
			</tr>
		</table>
	</form>
</body>
</html>