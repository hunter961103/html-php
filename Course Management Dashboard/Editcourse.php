<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$matric = $_SESSION['matric'];
	$picture = $_SESSION['picture'];
	$course_code = $_GET["course_code"];
	$q = "SELECT * FROM courses WHERE course_code='$course_code'";
	$r = mysqli_query($dbc, $q);
	if($r) {
		$row = mysqli_fetch_array($r);
	}
	else {
		die(mysqli_error($dbc));
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
	<p style="color:blue; border-bottom-style:solid">Dashboard > Update Course<button onclick=back() style="float:right">Back</button></p>
	<h2>UPDATE COURSE</h2>
	<form action="Editcourse2.php" method="post">
		<table id="table">
			<tr>
				<th>Course Code</th>
				<td><input type="text" name="course_code" value="<?php echo $row['course_code']; ?>" autocomplete="off" readOnly="true"></td>
			</tr>
			<tr>
				<th>Course Name</th>
				<td><input type="text" name="course_name" value="<?php echo $row['course_name']; ?>" autocomplete="off" required></td>
			</tr>
			<tr>
				<th>Course Prerequisite</th>
				<td><input type="text" name="course_prerequisite" value="<?php echo $row['course_prerequisite']; ?>" autocomplete="off"></td>
			</tr>
			<tr>
				<th>Course Type</th>
				<td><select name="course_type" onchange="choice(this.value)"><option value="<?php echo $row['course_type']; ?>" selected><?php echo $row['course_type']; ?></option><option value="University Core">University Core</option><option value="Programme Core">Programme Core</option><option value="Field of Concentration">Field of Concentration</option></select></td>
			</tr>
			<?php if($row['course_type'] == "Field of Concentration") { ?>
			<tr>
				<th>Major</th>
				<td><select name="major"><option value="<?php echo $row['major']; ?>" selected><?php echo $row['major']; ?></option><option value="Information Management">Information Management</option><option value="Intelligent System">Intelligent System</option><option value="Computer Network">Computer Network</option><option value="Software Engineering">Software Engineering</option></select></td>
			</tr>
			<?php } ?>
			<p id="major"><?php if($row['course_type'] != "Field of Concentration") {echo "<input type='hidden' name='major' value=''>";} ?></p>
		</table>
		<input type="submit" value="Save changes">
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