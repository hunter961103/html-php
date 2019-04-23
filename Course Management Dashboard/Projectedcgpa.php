<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$matric = $_SESSION['matric'];
	$picture = $_SESSION['picture'];
	function get_closest($search, $array) {
		$closest = null;
		foreach($array as $item) {
			if($closest === null || abs($search - $closest) > abs($item - $search)) {
				$closest = $item;
			}
		}
		return $closest;
	}
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$current = $_POST["current"];
		$count1 = $_POST["count1"];
		$count2 = $_POST["count2"];
		$count3 = $_POST["count3"];
		$count4 = $_POST["count4"];
		$progps1 = $subchs1 = $progps2 = $subchs2 = $progps3 = $subchs3 = $progps4 = $subchs4 = 0;
		$maxgps1 = $mingps1 = $maxgps2 = $mingps2 = $maxgps3 = $mingps3 = $maxgps4 = $mingps4 = 0;
		for($num = 0; $num < $count1; $num++) {
			if($_POST["grade1"][$num] != "") {
				$grade = $_POST["grade1"][$num];
				$grade_point = "";
				switch($grade) {
					case "A+":
						$grade_point = 4;
						$status = "taken";
						break;
					case "A":
						$grade_point = 4;
						$status = "taken";
						break;
					case "A-":
						$grade_point = 3.67;
						$status = "taken";
						break;
					case "B+":
						$grade_point = 3.33;
						$status = "taken";
						break;
					case "B":
						$grade_point = 3;
						$status = "taken";
						break;
					case "B-":
						$grade_point = 2.67;
						$status = "taken";
						break;
					case "C+":
						$grade_point = 2.33;
						$status = "taken";
						break;
					case "C":
						$grade_point = 2;
						$status = "taken";
						break;
					case "C-":
						$grade_point = 1.67;
						$status = "taken";
						break;
					case "D+":
						$grade_point = 1.33;
						$status = "taken";
						break;
					case "D":
						$grade_point = 1;
						$status = "taken";
						break;
					case "F":
						$grade_point = 0;
						$status = "taken";
						break;
				}
				$credit_hour = $_POST["credit_hour1"][$num];
				$progps1 += ($grade_point * $credit_hour);
				if(!isset($_POST["status1"][$num])) {
					$maxgps1 += (4 * $credit_hour);
					$mingps1 += (2 * $credit_hour);
					echo $grade;
				}
				else if($_POST["status1"][$num] != "taken") {
					$maxgps1 += (4 * $credit_hour);
					$mingps1 += (2 * $credit_hour);
				}
				else {
					$maxgps1 += ($grade_point * $credit_hour);
					$mingps1 += ($grade_point * $credit_hour);
				}
				$subchs1 += $credit_hour;
			}
		}
		for($num = 0; $num < $count2; $num++) {
			if($_POST["grade2"][$num] != "") {
				$grade = $_POST["grade2"][$num];
				$grade_point = "";
				switch($grade) {
					case "A+":
						$grade_point = 4;
						$status = "taken";
						break;
					case "A":
						$grade_point = 4;
						$status = "taken";
						break;
					case "A-":
						$grade_point = 3.67;
						$status = "taken";
						break;
					case "B+":
						$grade_point = 3.33;
						$status = "taken";
						break;
					case "B":
						$grade_point = 3;
						$status = "taken";
						break;
					case "B-":
						$grade_point = 2.67;
						$status = "taken";
						break;
					case "C+":
						$grade_point = 2.33;
						$status = "taken";
						break;
					case "C":
						$grade_point = 2;
						$status = "taken";
						break;
					case "C-":
						$grade_point = 1.67;
						$status = "taken";
						break;
					case "D+":
						$grade_point = 1.33;
						$status = "taken";
						break;
					case "D":
						$grade_point = 1;
						$status = "taken";
						break;
					case "F":
						$grade_point = 0;
						$status = "taken";
						break;
				}
				$credit_hour = $_POST["credit_hour2"][$num];
				$progps2 += ($grade_point * $credit_hour);
				if(!isset($_POST["status2"][$num])) {
					$maxgps2 += (4 * $credit_hour);
					$mingps2 += (2 * $credit_hour);
				}
				else if($_POST["status2"][$num] != "taken") {
					$maxgps2 += (4 * $credit_hour);
					$mingps2 += (2 * $credit_hour);
				}
				else {
					$maxgps2 += ($grade_point * $credit_hour);
					$mingps2 += ($grade_point * $credit_hour);
				}
				$subchs2 += $credit_hour;
			}
		}
		for($num = 0; $num < $count3; $num++) {
			if($_POST["grade3"][$num] != "") {
				$grade = $_POST["grade3"][$num];
				$grade_point = "";
				switch($grade) {
					case "A+":
						$grade_point = 4;
						$status = "taken";
						break;
					case "A":
						$grade_point = 4;
						$status = "taken";
						break;
					case "A-":
						$grade_point = 3.67;
						$status = "taken";
						break;
					case "B+":
						$grade_point = 3.33;
						$status = "taken";
						break;
					case "B":
						$grade_point = 3;
						$status = "taken";
						break;
					case "B-":
						$grade_point = 2.67;
						$status = "taken";
						break;
					case "C+":
						$grade_point = 2.33;
						$status = "taken";
						break;
					case "C":
						$grade_point = 2;
						$status = "taken";
						break;
					case "C-":
						$grade_point = 1.67;
						$status = "taken";
						break;
					case "D+":
						$grade_point = 1.33;
						$status = "taken";
						break;
					case "D":
						$grade_point = 1;
						$status = "taken";
						break;
					case "F":
						$grade_point = 0;
						$status = "taken";
						break;
				}
				$credit_hour = $_POST["credit_hour3"][$num];
				$progps3 += ($grade_point * $credit_hour);
				if(!isset($_POST["status3"][$num])) {
					$maxgps3 += (4 * $credit_hour);
					$mingps3 += (2 * $credit_hour);
				}
				else if($_POST["status3"][$num] != "taken") {
					$maxgps3 += (4 * $credit_hour);
					$mingps3 += (2 * $credit_hour);
				}
				else {
					$maxgps3 += ($grade_point * $credit_hour);
					$mingps3 += ($grade_point * $credit_hour);
				}
				$subchs3 += $credit_hour;
			}
		}
		for($num = 0; $num < $count4; $num++) {
			if($_POST["grade4"][$num] != "") {
				$grade = $_POST["grade4"][$num];
				$grade_point = "";
				switch($grade) {
					case "A+":
						$grade_point = 4;
						$status = "taken";
						break;
					case "A":
						$grade_point = 4;
						$status = "taken";
						break;
					case "A-":
						$grade_point = 3.67;
						$status = "taken";
						break;
					case "B+":
						$grade_point = 3.33;
						$status = "taken";
						break;
					case "B":
						$grade_point = 3;
						$status = "taken";
						break;
					case "B-":
						$grade_point = 2.67;
						$status = "taken";
						break;
					case "C+":
						$grade_point = 2.33;
						$status = "taken";
						break;
					case "C":
						$grade_point = 2;
						$status = "taken";
						break;
					case "C-":
						$grade_point = 1.67;
						$status = "taken";
						break;
					case "D+":
						$grade_point = 1.33;
						$status = "taken";
						break;
					case "D":
						$grade_point = 1;
						$status = "taken";
						break;
					case "F":
						$grade_point = 0;
						$status = "taken";
						break;
				}
				$credit_hour = $_POST["credit_hour4"][$num];
				$progps4 += ($grade_point * $credit_hour);
				if(!isset($_POST["status4"][$num])) {
					$maxgps4 += (4 * $credit_hour);
					$mingps4 += (2 * $credit_hour);
				}
				else if($_POST["status4"][$num] != "taken") {
					$maxgps4 += (4 * $credit_hour);
					$mingps4 += (2 * $credit_hour);
				}
				else {
					$maxgps4 += ($grade_point * $credit_hour);
					$mingps4 += ($grade_point * $credit_hour);
				}
				$subchs4 += $credit_hour;
			}
		}
		if($subchs1 + $subchs2 + $subchs3 + $subchs4 != 0) {
			$array = array(4, 3.67, 3.33, 3, 2.67, 2.33, 2, 1.67, 1.33, 1, 0);
			$projected = get_closest(($progps1 + $progps2 + $progps3 + $progps4) / ($subchs1 + $subchs2 + $subchs3 + $subchs4), $array);
			$max = get_closest(($maxgps1 + $maxgps2 + $maxgps3 + $maxgps4) / ($subchs1 + $subchs2 + $subchs3 + $subchs4), $array);
			$min = get_closest(($mingps1 + $mingps2 + $mingps3 + $mingps4) / ($subchs1 + $subchs2 + $subchs3 + $subchs4), $array);
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
	<p style="color:blue; border-bottom-style:solid">Dashboard > Calculate Projected CGPA > Projected CGPA<button onclick=back() style="float:right">Back</button></p>
	<h2>PROJECTED CGPA</h2>
	<form>
		<table>
			<tr>
				<th>Current CGPA</th>
				<td><?php if($subchs1 + $subchs2 + $subchs3 + $subchs4 != 0) {echo sprintf("%.2f", $current);} ?></td>
			</tr>
			<tr>
				<th>Projected CGPA</th>
				<td><?php if($subchs1 + $subchs2 + $subchs3 + $subchs4 != 0) {echo sprintf("%.2f", $projected);} ?></td>
			</tr>
			<tr>
				<th>Maximum CGPA</th>
				<td><?php if($subchs1 + $subchs2 + $subchs3 + $subchs4 != 0) {echo sprintf("%.2f", $max);} ?></td>
			</tr>
			<tr>
				<th>Minimum CGPA</th>
				<td><?php if($subchs1 + $subchs2 + $subchs3 + $subchs4 != 0) {echo sprintf("%.2f", $min);} ?></td>
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