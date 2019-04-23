<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$matric = $_SESSION['matric'];
	$picture = $_SESSION['picture'];
	$current = $_GET["current"];
	$q1 = "SELECT * FROM courses WHERE course_type='University Core' AND programme IN ((SELECT programme FROM users WHERE matric='$matric'), '')";
	$r1 = mysqli_query($dbc, $q1);
	$q2 = "SELECT * FROM courses WHERE course_type='Programme Core' AND programme=(SELECT programme FROM users WHERE matric='$matric')";
	$r2 = mysqli_query($dbc, $q2);
	$q3 = "SELECT * FROM courses WHERE course_type='Field of Concentration' AND programme=(SELECT programme FROM users WHERE matric='$matric') AND major=(SELECT major FROM users WHERE matric='$matric')";
	$r3 = mysqli_query($dbc, $q3);
	$q4 = "SELECT * FROM courses WHERE course_type='Field of Concentration' AND programme=(SELECT programme FROM users WHERE matric='$matric') AND major NOT IN (SELECT major FROM users WHERE matric='$matric')";
	$r4 = mysqli_query($dbc, $q4);
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
		<li><a href="Courseadvisor.php">Course Advisor</a></li>
		<li style="float:right"><a href="Logout.php">Logout</a></li>
		<li style="float:right"><?php if($picture != "") {echo "<img src='".$picture."' height='15' width='15'> ".$username." ".$matric;}else {echo "<img src='https://www.freeiconspng.com/uploads/profile-icon-9.png' alt='' width='15' height='15'> ".$username." ".$matric;} ?></li>
	</ul>
	<p style="color:blue; border-bottom-style:solid">Dashboard > Calculate Projected CGPA<button onclick=back() style="float:right">Back</button></p>
	<h2>CALCULATE PROJECTED CGPA</h2>
	<form action="Projectedcgpa.php" method="post">
		<table>
			<tr><th colspan="3" style="text-align:center"><h3>University Core</h3></th></tr>
			<tr>
				<th width="10%">Course Code</th>
				<th width="80%">Course Name</th>
				<th width="10%">Grade</th>
			</tr>
			<?php $count1 = 0; while($row1 = mysqli_fetch_array($r1)) { ?>
			<tr>
				<td><?php echo $row1['course_code']; ?></td>
				<td><?php echo $row1['course_name']; ?></td>
				<?php
					$course_code = $row1['course_code'];
					$r5 = mysqli_query($dbc, "SELECT * FROM dashboard WHERE matric='$matric' AND course_code='$course_code'");
					$row5 = mysqli_fetch_array($r5);
					$r6 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_code='$course_code'");
					$row6 = mysqli_fetch_array($r6);
				?>
				<td><select name="grade1[<?php echo $count1; ?>]"><option value="<?php echo $row5['grade']; ?>" selected><?php echo $row5['grade']; ?></option><option value="A+">A+</option><option value="A">A</option><option value="A-">A-</option><option value="B+">B+</option><option value="B">B</option><option value="B-">B-</option><option value="C+">C+</option><option value="C">C</option><option value="C-">C-</option><option value="D+">D+</option><option value="D">D</option><option value="F">F</option></select></td>
				<input type="hidden" name="status1[<?php echo $count1; ?>]" value="<?php echo $row5['status']; ?>">
				<input type="hidden" name="credit_hour1[<?php echo $count1; ?>]" value="<?php echo $row6['credit_hour']; ?>">
			</tr>
			<?php $count1++;} ?>
			<input type="hidden" name="count1" value="<?php echo $count1; ?>">
		</table>
		<table>
			<tr><th colspan="3" style="text-align:center"><h3>Programme Core</h3></th></tr>
			<tr>
				<th width="10%">Course Code</th>
				<th width="80%">Course Name</th>
				<th width="10%">Grade</th>
			</tr>
			<?php $count2 = 0; while($row2 = mysqli_fetch_array($r2)) { ?>
			<tr>
				<td><?php echo $row2['course_code']; ?></td>
				<td><?php echo $row2['course_name']; ?></td>
				<?php
					$course_code = $row2['course_code'];
					$r7 = mysqli_query($dbc, "SELECT * FROM dashboard WHERE matric='$matric' AND course_code='$course_code'");
					$row7 = mysqli_fetch_array($r7);
					$r8 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_code='$course_code'");
					$row8 = mysqli_fetch_array($r8);
				?>
				<td><select name="grade2[<?php echo $count2; ?>]"><option value="<?php echo $row7['grade']; ?>" selected><?php echo $row7['grade']; ?></option><option value="A+">A+</option><option value="A">A</option><option value="A-">A-</option><option value="B+">B+</option><option value="B">B</option><option value="B-">B-</option><option value="C+">C+</option><option value="C">C</option><option value="C-">C-</option><option value="D+">D+</option><option value="D">D</option><option value="F">F</option></select></td>
				<input type="hidden" name="status2[<?php echo $count2; ?>]" value="<?php echo $row7['status']; ?>">
				<input type="hidden" name="credit_hour2[<?php echo $count2; ?>]" value="<?php echo $row8['credit_hour']; ?>">
			</tr>
			<?php $count2++;} ?>
			<input type="hidden" name="count2" value="<?php echo $count2; ?>">
		</table>
		<table>
			<tr><th colspan="3" style="text-align:center"><h3>Field of Concentration</h3></th></tr>
			<tr>
				<th width="10%">Course Code</th>
				<th width="80%">Course Name</th>
				<th width="10%">Grade</th>
			</tr>
			<?php $count3 = 0; while($row3 = mysqli_fetch_array($r3)) { ?>
			<tr>
				<td><?php echo $row3['course_code']; ?></td>
				<td><?php echo $row3['course_name']; ?></td>
				<?php
					$course_code = $row3['course_code'];
					$r9 = mysqli_query($dbc, "SELECT * FROM dashboard WHERE matric='$matric' AND course_code='$course_code'");
					$row9 = mysqli_fetch_array($r9);
					$r10 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_code='$course_code'");
					$row10 = mysqli_fetch_array($r10);
				?>
				<td><select name="grade3[<?php echo $count3; ?>]"><option value="<?php echo $row9['grade']; ?>" selected><?php echo $row9['grade']; ?></option><option value="A+">A+</option><option value="A">A</option><option value="A-">A-</option><option value="B+">B+</option><option value="B">B</option><option value="B-">B-</option><option value="C+">C+</option><option value="C">C</option><option value="C-">C-</option><option value="D+">D+</option><option value="D">D</option><option value="F">F</option></select></td>
				<input type="hidden" name="status3[<?php echo $count3; ?>]" value="<?php echo $row9['status']; ?>">
				<input type="hidden" name="credit_hour3[<?php echo $count3; ?>]" value="<?php echo $row10['credit_hour']; ?>">
			</tr>
			<?php $count3++;} ?>
			<input type="hidden" name="count3" value="<?php echo $count3; ?>">
		</table>
		<table>
			<tr><th colspan="3" style="text-align:center"><h3>Other Field of Concentration</h3></th></tr>
			<tr>
				<th width="10%">Course Code</th>
				<th width="80%">Course Name</th>
				<th width="10%">Grade</th>
			</tr>
			<?php $count4 = 0; while($row4 = mysqli_fetch_array($r4)) { ?>
			<tr>
				<td><?php echo $row4['course_code']; ?></td>
				<td><?php echo $row4['course_name']; ?></td>
				<?php
					$course_code = $row4['course_code'];
					$r11 = mysqli_query($dbc, "SELECT * FROM dashboard WHERE matric='$matric' AND course_code='$course_code'");
					$row11 = mysqli_fetch_array($r11);
					$r12 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_code='$course_code'");
					$row12 = mysqli_fetch_array($r12);
				?>
				<td><select name="grade4[<?php echo $count4; ?>]"><option value="<?php echo $row11['grade']; ?>" selected><?php echo $row11['grade']; ?></option><option value="A+">A+</option><option value="A">A</option><option value="A-">A-</option><option value="B+">B+</option><option value="B">B</option><option value="B-">B-</option><option value="C+">C+</option><option value="C">C</option><option value="C-">C-</option><option value="D+">D+</option><option value="D">D</option><option value="F">F</option></select></td>
				<input type="hidden" name="status4[<?php echo $count4; ?>]" value="<?php echo $row11['status']; ?>">
				<input type="hidden" name="credit_hour4[<?php echo $count4; ?>]" value="<?php echo $row12['credit_hour']; ?>">
			</tr>
			<?php $count4++;} ?>
			<input type="hidden" name="count4" value="<?php echo $count4; ?>">
		</table>
		<br>
		<input type="hidden" name="current" value="<?php echo $current; ?>">
		<input type="submit" value="Calculate">
		<input type="reset" value="Cancel">
	</form>
<script>
	function back() {
		window.history.back();
	}
</script>
</body>
</html>