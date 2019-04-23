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
		$count = $_POST["count"];
		for($num = 0; $num < $count; $num++) {
			if(isset($_POST["submit"][$num])) {
				$course_code = test_input($_POST["course_code"][$num]);
				$student_matric = test_input($_POST["student_matric"][$num]);
				$programme = test_input($_POST["programme"][$num]);
				$semester = test_input($_POST["semester"][$num]);
				$q1 = "INSERT INTO dashboard (course_code, semester, status, matric) VALUES ('$course_code', '$semester', 'taking', '$student_matric')";
				$r1 = mysqli_query($dbc, $q1);
				if($r1) {
					echo "<script>
						  window.alert('Successfully registered selected course');
						  window.location.href = 'Result.php?matric=".$student_matric."&programme=".$programme."';
						  </script>";
				}
				else {
					die(mysqli_error($dbc));
				}
			}
		}
	}
	else {
		$student_matric = $_GET["student_matric"];
		$programme = $_GET["programme"];
	}
	$q = "SELECT * FROM courses WHERE course_code NOT IN (SELECT course_code FROM dashboard WHERE matric='$student_matric') AND programme IN ('$programme', '')";
	$r = mysqli_query($dbc, $q);
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
	input[type=text], select {
		padding: 6px 10px;
		margin: 8px 0;
		border: 2px solid #1f455e;
		border-radius: 4px;
	}
	#none {
		background-color: transparent;
	}
	#input {
		background-image: url("https://cdn1.iconfinder.com/data/icons/hawcons/32/698627-icon-111-search-512.png");
		background-position: 10px 8px;
		background-size: 10% 55%;
		background-repeat: no-repeat;
		padding: 12px 20px 12px 40px;
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
	<p style="color:blue; border-bottom-style:solid">Student Info > Edit Student's Dashboard > Register Course<button onclick=back() style="float:right">Back</button></p>
	<h2>REGISTER COURSE</h2>
	<ul id="none">
		<li><b>Search:</b> <input type="text" id="input" placeholder="Search for course name" onkeyup="search()"></li>
		<li style="float:right"><b>Sort by:</b> <select onchange="sort(this.value)"><option value="0">Course Code</option><option value="1">Course Name</option><option value="3">Credit Hour</option></select></li>
	</ul>
	<table id="courselist">
		<tr>
			<th>Course Code</th>
			<th>Course Name</th>
			<th>Course Prerequisite</th>
			<th>Credit Hour</th>
			<th>Semester</th>
			<th>&nbsp;</th>
		</tr>
		<form action="Registercourse.php" method="post">
			<?php $count = 0; while($row = mysqli_fetch_array($r)) { ?>
			<tr>
				<td><?php echo $row['course_code']; ?></td>
				<td><?php echo $row['course_name']; ?></td>
				<td><?php echo $row['course_prerequisite']; ?></td>
				<td><?php echo $row['credit_hour']; ?></td>
				<td><select name="semester[<?php echo $count; ?>]"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select></td>
				<input type="hidden" name="course_code[<?php echo $count; ?>]" value="<?php echo $row['course_code']; ?>">
				<input type="hidden" name="student_matric[<?php echo $count; ?>]" value="<?php echo $student_matric; ?>">
				<input type="hidden" name="programme[<?php echo $count; ?>]" value="<?php echo $programme; ?>">
				<td><input type="image" name="submit[<?php echo $count; ?>]" src="http://gradblog.schulich.yorku.ca/wp-content/uploads/2016/09/Wait-List-icon-1.png" alt="" width="15" height="15" border="0" title="Register"></td>
			</tr>
			<?php $count++;} ?>
			<input type="hidden" name="count" value="<?php echo $count; ?>">
		</form>
	</table>
<script>
	function back() {
		window.history.back();
	}
	function search() {
		var input, filter, table, tr, td, value;
		input = document.getElementById("input");
		filter = input.value.toUpperCase();
		table = document.getElementById("courselist");
		tr = table.getElementsByTagName("tr");
		for(var i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[1];
			if(td) {
				value = td.textContent;
				if(value.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				}
				else {
					tr[i].style.display = "none";
				}
			}
		}
	}
	function sort(value) {
		var table, rows, column, switching, x, y, shouldSwitch;
		table = document.getElementById("courselist");
		column = value;
		switching = true;
		while(switching) {
			switching = false;
			rows = table.getElementsByTagName("tr");
			for(var i = 1; i < (rows.length - 1); i++) {
				shouldSwitch = false;
				x = rows[i].getElementsByTagName("td")[column];
				y = rows[i + 1].getElementsByTagName("td")[column];
				if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
					shouldSwitch = true;
					break;
				}
			}
			if (shouldSwitch) {
				rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
				switching = true;
			}
		}
	}
</script>
</body>
</html>