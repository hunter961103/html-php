<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$matric = $_SESSION['matric'];
	$picture = $_SESSION['picture'];
	$q1 = "SELECT MAX(semester) AS semester FROM dashboard WHERE matric='$matric'";
	$r1 = mysqli_query($dbc, $q1);
	$row1 = mysqli_fetch_array($r1);
	$semester = $row1['semester'] + 1;
	if($semester < 3) {
		$q2 = "SELECT * FROM advisor WHERE programme=(SELECT programme FROM users WHERE matric='$matric') AND semester='$semester'";
		$r2 = mysqli_query($dbc, $q2);
	}
	else {
		$q2 = "SELECT * FROM advisor WHERE programme=(SELECT programme FROM users WHERE matric='$matric') AND semester='$semester' AND major=(SELECT major FROM users WHERE matric='$matric')";
		$r2 = mysqli_query($dbc, $q2);
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
</style>
<body>
	<h1>COURSE MANAGEMENT DASHBOARD</h1>
	<ul>
		<li><a href="Personalinfo.php">Personal Info</a></li>
		<li><a href="Dashboard.php">Dashboard</a></li>
		<li><a href="Courseadvisor.php">Course Advisor</a></li>
		<li style="float:right"><a href="Logout.php">Logout</a></li>
		<li style="float:right"><?php if($picture != "") {echo "<img src='".$picture."' height='15' width='15'> ".$username." ".$matric;}else {echo "<img src='https://www.freeiconspng.com/uploads/profile-icon-9.png' alt='' width='15' height='15'> ".$username." ".$matric;} ?></li>
	</ul>
	<p style="color:blue; border-bottom-style:solid">Course Advisor > Recommended Courses Next Semester<button onclick=back() style="float:right">Back</button></p>
	<h2>RECOMMENDED COURSES NEXT SEMESTER</h2>
	<table>
		<tr>
			<th>Course Code</th>
			<th>Course Name</th>
			<th>Credit Hour</th>
		</tr>
		<?php while($row2 = mysqli_fetch_array($r2)) {
			$course_code = $row2['course_code'];
			if($course_code == "OPTION14") { ?>
				<tr>
					<td rowspan="3"><?php echo "Field of Concentration (Elective)"; ?></td>
				</tr>
			<?php }
			else if($course_code == "OPTION24") { ?>
				<tr>
					<td rowspan="3"><?php echo "Other Field of Concentration"; ?></td>
				</tr>
			<?php }
			else if($course_code == "OPTIONX3") { ?>
				<tr>
					<td rowspan="3"><?php echo "Free Elective"; ?></td>
				</tr>
			<?php }
			else {
				$r3 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_code='$course_code'");
				while($row3 = mysqli_fetch_array($r3)) { ?>
				<tr>
					<td><?php echo $row3['course_code']; ?></td>
					<td><?php echo $row3['course_name']; ?></td>
					<td><?php echo $row3['credit_hour']; ?></td>
				</tr>
				<?php }
			}
		} ?>
	</table>
<script>
	function back() {
		window.history.back();
	}
</script>
</body>
</html>