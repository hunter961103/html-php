<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$matric = $_SESSION['matric'];
	$picture = $_SESSION['picture'];
	$student_matric = $_GET["matric"];
	$programme = $_GET["programme"];
	$q = "SELECT * FROM dashboard WHERE matric='$student_matric'";
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
	input[type=button] {
		background-color: #1f455e;
		color: white;
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
	<p style="color:blue; border-bottom-style:solid">Student Info > Edit Student's Dashboard<button onclick=back() style="float:right">Back</button></p>
	<h2>EDIT STUDENT'S DASHBOARD</h2>
	<ul id="none">
		<li><b>Search:</b> <input type="text" id="input" placeholder="Search for course code" onkeyup="search()"></li>
		<li style="float:right"><b>Sort by:</b> <select onchange="sort(this.value)"><option value="0">Course Code</option><option value="1">Semester</option><option value="2">Grade</option></select></li>
	</ul>
	<table id="resultlist">
		<tr>
			<th>Course Code</th>
			<th>Semester</th>
			<th>Grade</th>
			<th>Status</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_array($r)) { ?>
		<tr>
			<td><?php echo $row['course_code']; ?></td>
			<td><?php echo $row['semester']; ?></td>
			<td><?php echo $row['grade']; ?></td>
			<?php 
				if($row['status'] == "taken" || $row['grade'] != "") {
					echo "<td><img src='https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png' alt='' width='30' height='40' title='Course has been taken' /></td>";
				}
				else if($row['status'] == "taking" && $row['grade'] == "") {
					echo "<td><img src='https://cdn0.iconfinder.com/data/icons/back-to-school/90/circle-school-learn-study-subject-literature-book-512.png' alt='' width='27' height='27' title='Course currently taking' /></td>";
				}
				else {
					echo "<td><img src='https://vignette.wikia.nocookie.net/sqmegapolis/images/3/30/X-mark-3-256.png/revision/latest?cb=20130403220653' alt='' width='30' height='30' title='Course has not taken' /></td>";
				}
			?>
			<td><pre><a href="Editresult.php?course_code=<?php echo $row['course_code']; ?>&student_matric=<?php echo $row['matric']; ?>&programme=<?php echo $programme; ?>" title="Edit"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Edit_font_awesome.svg/500px-Edit_font_awesome.svg.png" alt="" width="15" height="15" /></a>    <a href="Deleteresult.php?course_code=<?php echo $row['course_code']; ?>&student_matric=<?php echo $row['matric']; ?>&programme=<?php echo $programme; ?>" title="Delete"><img src="https://img.icons8.com/metro/1600/delete.png" alt="" width="15" height="15" /></a></pre></td>
		</tr>
		<?php } ?>
	</table>
	<br>
	<a href="Registercourse.php?student_matric=<?php echo $student_matric; ?>&programme=<?php echo $programme; ?>"><input type="button" value="Register course"></a>
<script>
	function back() {
		window.history.back();
	}
	function search() {
		var input, filter, table, tr, td, value;
		input = document.getElementById("input");
		filter = input.value.toUpperCase();
		table = document.getElementById("resultlist");
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
		table = document.getElementById("resultlist");
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