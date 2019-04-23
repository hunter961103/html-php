<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$matric = $_SESSION['matric'];
	$picture = $_SESSION['picture'];
	if($_SESSION['user_type'] == "admin") {
		$r = mysqli_query($dbc, "SELECT * FROM courses WHERE course_type='University Core'");
		$r2 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_type='Programme Core'");
		$r4 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_type='Field of Concentration'");
	}
	if($_SESSION['user_type'] == "student") {
		$r = mysqli_query($dbc, "SELECT * FROM courses WHERE course_type='University Core' AND programme IN ((SELECT programme FROM users WHERE matric='$matric'), '')");
		$r2 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_type='Programme Core' AND programme=(SELECT programme FROM users WHERE matric='$matric')");
		$r4 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_type='Field of Concentration' AND programme=(SELECT programme FROM users WHERE matric='$matric') AND major=(SELECT major FROM users WHERE matric='$matric')");
		$r6 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_type='Field of Concentration' AND programme=(SELECT programme FROM users WHERE matric='$matric') AND major NOT IN (SELECT major FROM users WHERE matric='$matric')");
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
	li a:hover, li:nth-child(2) {
		background-color: #111;
	}
	img {
		border-radius: 50%;
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
	input {
		padding: 6px 10px;
		margin: 8px 0;
		border: 2px solid #1f455e;
		border-radius: 4px;
		background-color: #1f455e;
		color: white;
	}
	#focus {
		border: 2px solid black;
	}
</style>
<body>
	<h1>COURSE MANAGEMENT DASHBOARD</h1>
	<ul>
		<li><a href="Personalinfo.php">Personal Info</a></li>
		<li><a>Dashboard</a></li>
		<li><?php if($_SESSION['user_type'] == "student") { ?>
			<a href="Courseadvisor.php">Course Advisor</a>
		<?php } ?></li>
		<li><?php if($_SESSION['user_type'] == "admin") { ?>
			<a href="Studentinfo.php">Student Info</a>
		<?php } ?></li>
		<li style="float:right"><a href="Logout.php">Logout</a></li>
		<li style="float:right"><?php if($picture != "") {echo "<img src='".$picture."' height='15' width='15'> ".$username." ".$matric;}else {echo "<img src='https://www.freeiconspng.com/uploads/profile-icon-9.png' alt='' width='15' height='15'> ".$username." ".$matric;} ?></li>
	</ul>
	<h2>DASHBOARD</h2>
	<table>
		<?php if($_SESSION['user_type'] == "admin") { ?>
			<tr><th colspan="5" style="text-align:center"><h3>University Core</h3></th></tr>
		<?php } ?>
		<?php if($_SESSION['user_type'] == "student") { ?>
			<tr><th colspan="11" style="text-align:center"><h3>University Core</h3></th></tr>
		<?php } ?>
		<tr>
			<th width="10%" rowspan="2">Course Code</th>
			<th width="35%" rowspan="2">Course Name</th>
			<?php if($_SESSION['user_type'] == "admin") { ?>
				<th width="35%" rowspan="2">Course Prerequisite</th>
				<th width="10%" rowspan="2">Credit Hour</th>
				<th width="10%" rowspan="2">&nbsp;</th>
			<?php } ?>
			<?php if($_SESSION['user_type'] == "student") { ?>
				<th width="50%" colspan="8">Grade/Grade Point</th>
				<th width="5%" rowspan="2">Status</th>
			<?php } ?>
		</tr>
		<?php if($_SESSION['user_type'] == "admin") { ?>
			<tr></tr>
		<?php } ?>
		<?php if($_SESSION['user_type'] == "student") { ?>
		<tr>
			<th width="6.25%">Sem 1</th>
			<th width="6.25%">Sem 2</th>
			<th width="6.25%">Sem 3</th>
			<th width="6.25%">Sem 4</th>
			<th width="6.25%">Sem 5</th>
			<th width="6.25%">Sem 6</th>
			<th width="6.25%">Sem 7</th>
			<th width="6.25%">Sem 8</th>
		</tr>
		<?php } ?>
		<?php while($row = mysqli_fetch_array($r)) { ?>
		<tr>
			<td><?php echo $row['course_code']; ?></td>
			<td><?php echo $row['course_name']; ?></td>
			<?php if($_SESSION['user_type'] == "admin") { ?>
				<td><?php echo $row['course_prerequisite']; ?></td>
				<td><?php echo $row['credit_hour']; ?></td>
				<td><pre><a href="Editcourse.php?course_code=<?php echo $row['course_code']; ?>" title="Edit"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Edit_font_awesome.svg/500px-Edit_font_awesome.svg.png" alt="" width="15" height="15" /></a>    <a href="Deletecourse.php?course_code=<?php echo $row['course_code']; ?>" title="Delete"><img src="https://img.icons8.com/metro/1600/delete.png" alt="" width="15" height="15" /></a></pre></td>
			<?php } ?>
			<?php if($_SESSION['user_type'] == "student") {
				$course_code = $row['course_code'];
				$r1 = mysqli_query($dbc, "SELECT * FROM dashboard WHERE matric='$matric' AND course_code='$course_code'");
				$semester = $grade = $grade_point = $status = "";
				while($row1 = mysqli_fetch_array($r1)) {
					$semester = $row1['semester'];
					$grade = $row1['grade'];
					$grade_point = sprintf("%.2f", $row1['grade_point']);
					$status = $row1['status'];
				}
				switch($semester) {
					case 1:
						if($grade != "") {
							echo "<td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 2:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 3:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 4:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 5:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 6:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 7:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 8:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>";
						}
						break;
					default:
						echo "<td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>";
				}
				if($status == "taken" || $grade != "") {
					echo "<td><img src='https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png' alt='' width='30' height='40' title='Course has been taken' /></td>";
				}
				else if($status == "taking" && $grade == "") {
					echo "<td><img src='https://cdn0.iconfinder.com/data/icons/back-to-school/90/circle-school-learn-study-subject-literature-book-512.png' alt='' width='27' height='27' title='Course currently taking' /></td>";
				}
				else {
					echo "<td><img src='https://vignette.wikia.nocookie.net/sqmegapolis/images/3/30/X-mark-3-256.png/revision/latest?cb=20130403220653' alt='' width='30' height='30' title='Course has not taken' /></td>";
				}
			} ?>
		</tr>
		<?php } ?>
	</table>
	<table>
		<?php if($_SESSION['user_type'] == "admin") { ?>
			<tr><th colspan="5" style="text-align:center"><h3>Programme Core</h3></th></tr>
		<?php } ?>
		<?php if($_SESSION['user_type'] == "student") { ?>
			<tr><th colspan="11" style="text-align:center"><h3>Programme Core</h3></th></tr>
		<?php } ?>
		<tr>
			<th width="10%" rowspan="2">Course Code</th>
			<th width="35%" rowspan="2">Course Name</th>
			<?php if($_SESSION['user_type'] == "admin") { ?>
				<th width="35%" rowspan="2">Course Prerequisite</th>
				<th width="10%" rowspan="2">Credit Hour</th>
				<th width="10%" rowspan="2">&nbsp;</th>
			<?php } ?>
			<?php if($_SESSION['user_type'] == "student") { ?>
				<th width="50%" colspan="8">Grade/Grade Point</th>
				<th width="5%" rowspan="2">Status</th>
			<?php } ?>
		</tr>
		<?php if($_SESSION['user_type'] == "admin") { ?>
			<tr></tr>
		<?php } ?>
		<?php if($_SESSION['user_type'] == "student") { ?>
		<tr>
			<th width="6.25%">Sem 1</th>
			<th width="6.25%">Sem 2</th>
			<th width="6.25%">Sem 3</th>
			<th width="6.25%">Sem 4</th>
			<th width="6.25%">Sem 5</th>
			<th width="6.25%">Sem 6</th>
			<th width="6.25%">Sem 7</th>
			<th width="6.25%">Sem 8</th>
		</tr>
		<?php } ?>
		<?php while($row2 = mysqli_fetch_array($r2)) { ?>
		<tr>
			<td><?php echo $row2['course_code']; ?></td>
			<td><?php echo $row2['course_name']; ?></td>
			<?php if($_SESSION['user_type'] == "admin") { ?>
				<td><?php echo $row2['course_prerequisite']; ?></td>
				<td><?php echo $row2['credit_hour']; ?></td>
				<td><pre><a href="Editcourse.php?course_code=<?php echo $row2['course_code']; ?>" title="Edit"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Edit_font_awesome.svg/500px-Edit_font_awesome.svg.png" alt="" width="15" height="15" /></a>    <a href="Deletecourse.php?course_code=<?php echo $row2['course_code']; ?>" title="Delete"><img src="https://img.icons8.com/metro/1600/delete.png" alt="" width="15" height="15" /></a></pre></td>
			<?php } ?>
			<?php if($_SESSION['user_type'] == "student") {
				$course_code = $row2['course_code'];
				$r3 = mysqli_query($dbc, "SELECT * FROM dashboard WHERE matric='$matric' AND course_code='$course_code'");
				$semester = $grade = $grade_point = $status = "";
				while($row3 = mysqli_fetch_array($r3)) {
					$semester = $row3['semester'];
					$grade = $row3['grade'];
					$grade_point = sprintf("%.2f", $row3['grade_point']);
					$status = $row3['status'];
				}
				switch($semester) {
					case 1:
						if($grade != "") {
							echo "<td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 2:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 3:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 4:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 5:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 6:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 7:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 8:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>";
						}
						break;
					default:
						echo "<td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>";
				}
				if($status == "taken" || $grade != "") {
					echo "<td><img src='https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png' alt='' width='30' height='40' title='Course has been taken' /></td>";
				}
				else if($status == "taking" && $grade == "") {
					echo "<td><img src='https://cdn0.iconfinder.com/data/icons/back-to-school/90/circle-school-learn-study-subject-literature-book-512.png' alt='' width='27' height='27' title='Course currently taking' /></td>";
				}
				else {
					echo "<td><img src='https://vignette.wikia.nocookie.net/sqmegapolis/images/3/30/X-mark-3-256.png/revision/latest?cb=20130403220653' alt='' width='30' height='30' title='Course has not taken' /></td>";
				}
			} ?>
		</tr>
		<?php } ?>
	</table>
	<table>
		<?php if($_SESSION['user_type'] == "admin") { ?>
			<tr><th colspan="5" style="text-align:center"><h3>Field of Concentration</h3></th></tr>
		<?php } ?>
		<?php if($_SESSION['user_type'] == "student") { ?>
			<tr><th colspan="11" style="text-align:center"><h3>Field of Concentration</h3></th></tr>
		<?php } ?>
		<tr>
			<th width="10%" rowspan="2">Course Code</th>
			<th width="35%" rowspan="2">Course Name</th>
			<?php if($_SESSION['user_type'] == "admin") { ?>
				<th width="35%" rowspan="2">Course Prerequisite</th>
				<th width="10%" rowspan="2">Credit Hour</th>
				<th width="10%" rowspan="2">&nbsp;</th>
			<?php } ?>
			<?php if($_SESSION['user_type'] == "student") { ?>
				<th width="50%" colspan="8">Grade/Grade Point</th>
				<th width="5%" rowspan="2">Status</th>
			<?php } ?>
		</tr>
		<?php if($_SESSION['user_type'] == "admin") { ?>
			<tr></tr>
		<?php } ?>
		<?php if($_SESSION['user_type'] == "student") { ?>
		<tr>
			<th width="6.25%">Sem 1</th>
			<th width="6.25%">Sem 2</th>
			<th width="6.25%">Sem 3</th>
			<th width="6.25%">Sem 4</th>
			<th width="6.25%">Sem 5</th>
			<th width="6.25%">Sem 6</th>
			<th width="6.25%">Sem 7</th>
			<th width="6.25%">Sem 8</th>
		</tr>
		<?php } ?>
		<?php while($row4 = mysqli_fetch_array($r4)) { ?>
		<tr>
			<td><?php echo $row4['course_code']; ?></td>
			<td><?php echo $row4['course_name']; ?></td>
			<?php if($_SESSION['user_type'] == "admin") { ?>
				<td><?php echo $row4['course_prerequisite']; ?></td>
				<td><?php echo $row4['credit_hour']; ?></td>
				<td><pre><a href="Editcourse.php?course_code=<?php echo $row4['course_code']; ?>" title="Edit"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Edit_font_awesome.svg/500px-Edit_font_awesome.svg.png" alt="" width="15" height="15" /></a>    <a href="Deletecourse.php?course_code=<?php echo $row4['course_code']; ?>" title="Delete"><img src="https://img.icons8.com/metro/1600/delete.png" alt="" width="15" height="15" /></a></pre></td>
			<?php } ?>
			<?php if($_SESSION['user_type'] == "student") {
				$course_code = $row4['course_code'];
				$r5 = mysqli_query($dbc, "SELECT * FROM dashboard WHERE matric='$matric' AND course_code='$course_code'");
				$semester = $grade = $grade_point = $status = "";
				while($row5 = mysqli_fetch_array($r5)) {
					$semester = $row5['semester'];
					$grade = $row5['grade'];
					$grade_point = sprintf("%.2f", $row5['grade_point']);
					$status = $row5['status'];
				}
				switch($semester) {
					case 1:
						if($grade != "") {
							echo "<td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 2:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 3:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 4:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 5:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 6:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 7:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>
								  <td>&nbsp;</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>
								  <td>&nbsp;</td>";
						}
						break;
					case 8:
						if($grade != "") {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>".$grade."/".$grade_point."</td>";
						}
						else {
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td style='background-color:#3cb371'>&nbsp;</td>";
						}
						break;
					default:
						echo "<td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>";
				}
				if($status == "taken" || $grade != "") {
					echo "<td><img src='https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png' alt='' width='30' height='40' title='Course has been taken' /></td>";
				}
				else if($status == "taking" && $grade == "") {
					echo "<td><img src='https://cdn0.iconfinder.com/data/icons/back-to-school/90/circle-school-learn-study-subject-literature-book-512.png' alt='' width='27' height='27' title='Course currently taking' /></td>";
				}
				else {
					echo "<td><img src='https://vignette.wikia.nocookie.net/sqmegapolis/images/3/30/X-mark-3-256.png/revision/latest?cb=20130403220653' alt='' width='30' height='30' title='Course has not taken' /></td>";
				}
			} ?>
		</tr>
		<?php } ?>
	</table>
	<table>
		<?php if($_SESSION['user_type'] == "student") { ?>
			<tr>
				<th colspan="11" style="text-align:center"><h3>Other Field of Concentration</h3></th>
			</tr>
			<tr>
				<th width="10%" rowspan="2">Course Code</th>
				<th width="35%" rowspan="2">Course Name</th>
				<th width="50%" colspan="8">Grade/Grade Point</th>
				<th width="5%" rowspan="2">Status</th>
			</tr>
			<tr>
				<th width="6.25%">Sem 1</th>
				<th width="6.25%">Sem 2</th>
				<th width="6.25%">Sem 3</th>
				<th width="6.25%">Sem 4</th>
				<th width="6.25%">Sem 5</th>
				<th width="6.25%">Sem 6</th>
				<th width="6.25%">Sem 7</th>
				<th width="6.25%">Sem 8</th>
			</tr>
			<?php while($row6 = mysqli_fetch_array($r6)) { ?>
			<tr>
				<td><?php echo $row6['course_code']; ?></td>
				<td><?php echo $row6['course_name']; ?></td>
				<?php
					$course_code = $row6['course_code'];
					$r7 = mysqli_query($dbc, "SELECT * FROM dashboard WHERE matric='$matric' AND course_code='$course_code'");
					$semester = $grade = $grade_point = $status = "";
					while($row7 = mysqli_fetch_array($r7)) {
						$semester = $row7['semester'];
						$grade = $row7['grade'];
						$grade_point = sprintf("%.2f", $row7['grade_point']);
						$status = $row7['status'];
					}
					switch($semester) {
						case 1:
							if($grade != "") {
								echo "<td>".$grade."/".$grade_point."</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							else {
								echo "<td style='background-color:#3cb371'>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							break;
						case 2:
							if($grade != "") {
								echo "<td>&nbsp;</td>
									  <td>".$grade."/".$grade_point."</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							else {
								echo "<td>&nbsp;</td>
									  <td style='background-color:#3cb371'>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							break;
						case 3:
							if($grade != "") {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>".$grade."/".$grade_point."</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							else {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td style='background-color:#3cb371'>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							break;
						case 4:
							if($grade != "") {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>".$grade."/".$grade_point."</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							else {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td style='background-color:#3cb371'>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							break;
						case 5:
							if($grade != "") {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>".$grade."/".$grade_point."</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							else {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td style='background-color:#3cb371'>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							break;
						case 6:
							if($grade != "") {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>".$grade."/".$grade_point."</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							else {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td style='background-color:#3cb371'>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							break;
						case 7:
							if($grade != "") {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>".$grade."/".$grade_point."</td>
									  <td>&nbsp;</td>";
							}
							else {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td style='background-color:#3cb371'>&nbsp;</td>
									  <td>&nbsp;</td>";
							}
							break;
						case 8:
							if($grade != "") {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>".$grade."/".$grade_point."</td>";
							}
							else {
								echo "<td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									  <td style='background-color:#3cb371'>&nbsp;</td>";
							}
							break;
						default:
							echo "<td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>";
					}
					if($status == "taken" || $grade != "") {
						echo "<td><img src='https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png' alt='' width='30' height='40' title='Course has been taken' /></td>";
					}
					else if($status == "taking" && $grade == "") {
						echo "<td><img src='https://cdn0.iconfinder.com/data/icons/back-to-school/90/circle-school-learn-study-subject-literature-book-512.png' alt='' width='27' height='27' title='Course currently taking' /></td>";
					}
					else {
						echo "<td><img src='https://vignette.wikia.nocookie.net/sqmegapolis/images/3/30/X-mark-3-256.png/revision/latest?cb=20130403220653' alt='' width='30' height='30' title='Course has not taken' /></td>";
					}
				?>
			</tr>
		<?php } ?>
		<tr id="focus">
			<th colspan="2">GPA</th>
			<?php
				for($semester = 1; $semester <= 8; $semester++) {
					$gps = $chs = 0;
					$r8 = mysqli_query($dbc, "SELECT * FROM dashboard WHERE matric='$matric' AND semester='$semester' AND status='taken'");
					while($row8 = mysqli_fetch_array($r8)) {
						$course_code = $row8['course_code'];
						$r9 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_code='$course_code'");
						while($row9 = mysqli_fetch_array($r9)) {
							$grade_point = $row8['grade_point'] * $row9['credit_hour'];
							$gps += $grade_point;
							$chs += $row9['credit_hour'];
						}
					}
					if($gps != 0 && $chs != 0) {
						$gpa = $gps / $chs;
						echo "<td id='focus'>".sprintf("%.2f", $gpa)."</td>";
					}
					else {
						echo "<td id='focus'>&nbsp;</td>";
					}
				}
				$cgps = $cchs = 0;
				$r10 = mysqli_query($dbc, "SELECT * FROM dashboard WHERE matric='$matric' AND status='taken'");
				while($row10 = mysqli_fetch_array($r10)) {
					$course_code = $row10['course_code'];
					$r11 = mysqli_query($dbc, "SELECT * FROM courses WHERE course_code='$course_code'");
					while($row11 = mysqli_fetch_array($r11)) {
						$grade_point = $row10['grade_point'] * $row11['credit_hour'];
						$cgps += $grade_point;
						$cchs += $row11['credit_hour'];
					}
				}
			?>
		</tr>
		<tr id="focus">
			<th colspan="2">Current CGPA</th>
			<td id="focus" colspan="8"><?php $current = 0; if($cgps != 0 && $cchs != 0) {$current = $cgps / $cchs; echo sprintf("%.2f", $current);} ?></td>
		</tr>
		<?php } ?>
	</table>
	<br>
	<?php if($_SESSION['user_type'] == "admin") { ?>
		<a href="Addcourse.php"><input type="button" value="Add course"></a>
	<?php }else { ?>
		<a href="Calculateprojectedcgpa.php?current=<?php echo $current; ?>"><input type="button" value="Calculate projected CGPA"></a>
	<?php } ?>
</body>
</html>