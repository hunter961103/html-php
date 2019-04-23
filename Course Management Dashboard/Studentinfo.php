<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$matric = $_SESSION['matric'];
	$picture = $_SESSION['picture'];
	$r = mysqli_query($dbc, "SELECT * FROM users WHERE user_type='student'");
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
		<li><a>Student Info</a></li>
		<li style="float:right"><a href="Logout.php">Logout</a></li>
		<li style="float:right"><?php if($picture != "") {echo "<img src='".$picture."' height='15' width='15'> ".$username." ".$matric;}else {echo "<img src='https://www.freeiconspng.com/uploads/profile-icon-9.png' alt='' width='15' height='15'> ".$username." ".$matric;} ?></li>
	</ul>
	<h2>STUDENT INFO</h2>
	<ul id="none">
		<li><b>Search:</b> <input type="text" id="input" placeholder="Search for student name" onkeyup="search()"></li>
		<li style="float:right"><b>Sort by:</b> <select onchange="sort(this.value)"><option value="0">Matric No</option><option value="1">Student Name</option><option value="4">Programme</option></select></li>
	</ul>
	<table id="studentlist">
		<tr>
			<th>Matric No</th>
			<th>Student Name</th>
			<th>IC No</th>
			<th>Email</th>
			<th>Programme</th>
			<th>Total Credit</th>
			<th>Major</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_array($r)) { ?>
		<tr>
			<td><?php echo $row['matric']; ?></td>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['ic']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['programme']; ?></td>
			<td><?php echo $row['total_credit']; ?></td>
			<td><?php echo $row['major']; ?></td>
			<td><pre><a href="Result.php?matric=<?php echo $row['matric']; ?>&programme=<?php echo $row['programme']; ?>" title="Edit"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Edit_font_awesome.svg/500px-Edit_font_awesome.svg.png" alt="" width="15" height="15" /></a>    <a href="Deletestudent.php?matric=<?php echo $row['matric']; ?>" title="Delete"><img src="https://img.icons8.com/metro/1600/delete.png" alt="" width="15" height="15" /></a></pre></td>
		</tr>
		<?php } ?>
	</table>
	<br>
	<a href="Registerstudent.php"><input type="button" value="Register new student"></a>
<script>
	function search() {
		var input, filter, table, tr, td, value;
		input = document.getElementById("input");
		filter = input.value.toUpperCase();
		table = document.getElementById("studentlist");
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
		table = document.getElementById("studentlist");
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