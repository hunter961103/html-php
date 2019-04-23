<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$matric = $_SESSION['matric'];
	$picture = $_SESSION['picture'];
	$r1 = mysqli_query($dbc, "SELECT grade_point FROM dashboard WHERE matric='$matric' AND course_code='STID3014'");
	$row1 = mysqli_fetch_array($r1);
	$grade_point1 = $row1['grade_point'];
	$r2 = mysqli_query($dbc, "SELECT grade_point FROM dashboard WHERE matric='$matric' AND course_code='STID3024'");
	$row2 = mysqli_fetch_array($r2);
	$grade_point2 = $row2['grade_point'];
	$r3 = mysqli_query($dbc, "SELECT grade_point FROM dashboard WHERE matric='$matric' AND course_code='STIJ2024'");
	$row3 = mysqli_fetch_array($r3);
	$grade_point3 = $row3['grade_point'];
	$r4 = mysqli_query($dbc, "SELECT grade_point FROM dashboard WHERE matric='$matric' AND course_code='STIN1013'");
	$row4 = mysqli_fetch_array($r4);
	$grade_point4 = $row4['grade_point'];
	$r5 = mysqli_query($dbc, "SELECT grade_point FROM dashboard WHERE matric='$matric' AND course_code='STIK1014'");
	$row5 = mysqli_fetch_array($r5);
	$grade_point5 = $row5['grade_point'];
	$r6 = mysqli_query($dbc, "SELECT grade_point FROM dashboard WHERE matric='$matric' AND course_code='STIA2024'");
	$row6 = mysqli_fetch_array($r6);
	$grade_point6 = $row6['grade_point'];
	$im_point = (($grade_point1 * 4) + ($grade_point2 * 4) + ($grade_point3 * 4)) / 12;
	$is_point = $grade_point4;
	$cn_point = (($grade_point1 * 4) + ($grade_point3 * 4) + ($grade_point5 * 4)) / 12;
	$se_point = (($grade_point2 * 4) + ($grade_point6 * 4)) / 8;
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
	<p style="color:blue; border-bottom-style:solid">Course Advisor > Recommended Major<button onclick=back() style="float:right">Back</button></p>
	<h2>RECOMMENDED MAJOR</h2>
	<form>
		<table>
			<tr>
				<th>Information Management</th>
				<?php if($im_point >= $is_point && $im_point >= $cn_point && $im_point >= $se_point) { ?>
					<td>Recommended</td>
				<?php }else { ?>
					<td>Not recommended</td>
				<?php } ?>
			</tr>
			<tr>
				<th>Intelligent System</th>
				<?php if($is_point >= $im_point && $is_point >= $cn_point && $is_point >= $se_point) { ?>
					<td>Recommended</td>
				<?php }else { ?>
					<td>Not recommended</td>
				<?php } ?>
			</tr>
			<tr>
				<th>Computer Network</th>
				<?php if($cn_point >= $im_point && $cn_point >= $is_point && $cn_point >= $se_point) { ?>
					<td>Recommended</td>
				<?php }else { ?>
					<td>Not recommended</td>
				<?php } ?>
			</tr>
			<tr>
				<th>Software Engineering</th>
				<?php if($se_point >= $im_point && $se_point >= $is_point && $se_point >= $cn_point) { ?>
					<td>Recommended</td>
				<?php }else { ?>
					<td>Not recommended</td>
				<?php } ?>
			</tr>
		</table>
	</form>
<script>
	function back() {
		window.history.back();
	}
</script>
</body>
</html>