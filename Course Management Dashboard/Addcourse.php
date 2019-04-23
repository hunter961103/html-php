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
		$course_code = test_input($_POST["course_code"]);
		$course_name = test_input($_POST["course_name"]);
		$course_prerequisite = test_input($_POST["course_prerequisite"]);
		$programme = test_input($_POST["programme"]);
		$course_type = test_input($_POST["course_type"]);
		$major = test_input($_POST["major"]);
		if(is_numeric(substr($course_code, -1))) {
			$credit_hour = (int)substr($course_code, -1);
			$q1 = "SELECT course_code FROM courses WHERE course_code='$course_code'";
			$r1 = mysqli_query($dbc, $q1);
			if(!$r1) {
				die(mysqli_error($dbc));
			}
			if(mysqli_num_rows($r1) > 0) {
				echo "<script>
					  window.alert('Course code has been used');
					  window.history.back();
					  </script>";
			}
			$q2 = "INSERT INTO courses VALUES ('$course_code', '$course_name', '$course_prerequisite', '$credit_hour', '$programme', '$course_type', '$major')";
			$r2 = mysqli_query($dbc, $q2);
			if($r2) {
				echo "<script>
					  window.alert('Successfully added new course');
					  window.location.href = 'Dashboard.php';
					  </script>";
			}
			else {
				die(mysqli_error($dbc));
			}
		}
		else {
			echo "<script>
				  window.alert('Invalid course code');
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
	li a:hover, li:nth-child(2) {
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
	<p style="color:blue; border-bottom-style:solid">Dashboard > Add Course<button onclick=back() style="float:right">Back</button></p>
	<h2>ADD COURSE</h2>
	<form action="Addcourse.php" method="post">
		<table id="table">
			<tr>
				<th>Course Code</th>
				<td><input type="text" name="course_code" autocomplete="off" required></td>
			</tr>
			<tr>
				<th>Course Name</th>
				<td><input type="text" name="course_name" autocomplete="off" required></td>
			</tr>
			<tr>
				<th>Course Prerequisite</th>
				<td><input type="text" name="course_prerequisite" autocomplete="off"></td>
			</tr>
			<tr>
				<th>Programme</th>
				<td><select name="programme"><option value="Information Technology">Information Technology</option><option value="Business Administration">Business Administration</option></select></td>
			</tr>
			<tr>
				<th>Course Type</th>
				<td><select name="course_type" onchange="choice(this.value)"><option value="University Core">University Core</option><option value="Programme Core">Programme Core</option><option value="Field of Concentration">Field of Concentration</option></select></td>
			</tr>
			<p id="major"><input type='hidden' name='major' value=''></p>
		</table>
		<input type="submit" value="Add new course">
		<input type="reset" value="Cancel">
	</form>
<script>
	function back() {
		window.history.back();
	}
	function choice(value) {
		var table = document.getElementById("table");
		var trh = document.createElement("th");
		var trd = document.createElement("td");
		if(value == "Field of Concentration") {
			var tr = table.insertRow(-1);
			var th = tr.appendChild(trh);
			var td = tr.appendChild(trd);
			th.innerHTML = "Major";
			td.innerHTML = "<select name='major'><option value='Information Management'>Information Management</option><option value='Intelligent System'>Intelligent System</option><option value='Computer Network'>Computer Network</option><option value='Software Engineering'>Software Engineering</option></select>";
			document.getElementById("major").innerHTML = "";
		}
		else {
			if(table.rows.length == 5) {
				table.deleteRow(-1);
			}
			document.getElementById("major").innerHTML = "<input type='hidden' name='major' value=''>";
		}
	}
</script>
</body>
</html>