<?php
	session_start();
	require "Databaseconnect.php";
	if(!isset($_SESSION['username'])) {
		header("Location: Login.php");
	}
	$username = $_SESSION['username'];
	$q = "SELECT * FROM users where username='$username'";
	$r = mysqli_query($dbc, $q);
	if(!$r) {
		die(mysqli_error($dbc));
	}
	while($row = mysqli_fetch_array($r)) {
		$matric = $row['matric'];
		$picture = $row['picture'];
	}
	$_SESSION['matric'] = $matric;
	$_SESSION['picture'] = $picture;
	$q1 = "SELECT * FROM users WHERE matric='$matric'";
	$r1 = mysqli_query($dbc, $q1);
	if($r1) {
		$row1 = mysqli_fetch_array($r1);
	}
	else {
		die(mysqli_error($dbc));
	}
	if(isset($_POST["save_changes"])) {
		$major = $_POST["major"];
		$picture = "";
		if(isset($_FILES["picture"]) && $_FILES["picture"]["name"] != "") {
			$picture = "profile_picture/".$_FILES["picture"]["name"];
			$target = "profile_picture/".basename($picture);
			$imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
			if ($_FILES["picture"]["size"] > 500000) {
				echo "<script>
					  window.alert('Image file is too large');
					  window.location.href = 'Personalinfo.php';
					  </script>";
			}
			if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "jfif" && $imageFileType != "png" && $imageFileType != "gif" ) {
				echo "<script>
					  window.alert('Only JPG, JPEG, JFIF, PNG & GIF files are allowed');
					  window.location.href = 'Personalinfo.php';
					  </script>";
			}
			if(!move_uploaded_file($_FILES["picture"]["tmp_name"], $target)) {
				echo "<script>
				  window.alert('Failed to upload profile picture');
				  window.location.href = 'Personalinfo.php';
				  </script>";
			}
		}
		$q2 = "UPDATE users SET major='$major', picture='$picture' WHERE matric='$matric'";
		$r2 = mysqli_query($dbc, $q2);
		if($r2) {
			$_SESSION['picture'] = $picture;
			echo "<script>
				  window.alert('Successfully updated personal information');
				  window.location.href = 'Personalinfo.php';
				  </script>";
		}
		else {
			die(mysqli_error($dbc));
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
	li a:hover, li:nth-child(1) {
		background-color: #111;
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
	input[type=submit], input[type=button] {
		background-color: #1f455e;
		color: white;
	}
	input[type=reset] {
		border: 2px solid lightgrey;
		border-radius: 4px;
	}
	#img {
		border-radius: 50%;
	}
	#picture {
		border: 3px solid black;
	}
</style>
<body>
	<h1>COURSE MANAGEMENT DASHBOARD</h1>
	<ul>
		<li><a>Personal Info</a></li>
		<li><a href="Dashboard.php">Dashboard</a></li>
		<li><?php if($_SESSION['user_type'] == "student") { ?>
			<a href="Courseadvisor.php">Course Advisor</a>
		<?php } ?></li>
		<li><?php if($_SESSION['user_type'] == "admin") { ?>
			<a href="Studentinfo.php">Student Info</a>
		<?php } ?></li>
		<li style="float:right"><a href="Logout.php">Logout</a></li>
		<li style="float:right"><?php if($picture != "") {echo "<img id='img' src='".$picture."' height='15' width='15'> ".$username." ".$matric;}else {echo "<img id='img' src='https://www.freeiconspng.com/uploads/profile-icon-9.png' alt='' width='15' height='15'> ".$username." ".$matric;} ?></li>
	</ul>
	<h2>PERSONAL INFO</h2>
	<form action="Personalinfo.php" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<?php if(isset($_POST["edit_info"])) { ?>
					<td height="50px" colspan="2"><center><input type="file" name="picture" value="<?php echo $row1['picture']; ?>"></center></td>
				<?php } else { ?>
					<td height="200px" colspan="2"><center><?php if($row1['picture'] != "") {echo "<img id='picture' src='".$row1['picture']."' width='125' height='175'>";}else {echo "<img id='picture' src='http://www.hearthsidedistributors.com/site/hearthgrillsales/images/noimage.png' alt='' width='125' height='175' />";} ?></center></td>
				<?php } ?>
			</tr>
			<tr>
				<th>Matric No</th>
				<td><?php echo $row1['matric']; ?></td>
			</tr>
			<tr>
				<th>Name</th>
				<td><?php echo $row1['username']; ?></td>
			</tr>
			<tr>
				<th>IC No</th>
				<td><?php echo $row1['ic']; ?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $row1['email']; ?></td>
			</tr>
			<?php if($_SESSION['user_type'] == "student") { ?>
			<tr>
				<th>Programme</th>
				<td><?php echo $row1['programme']; ?></td>
			</tr>
			<tr>
				<th>Total Credit</th>
				<td><?php echo $row1['total_credit']; ?></td>
			</tr>
			<tr>
				<th>Major</th>
				<?php if(isset($_POST["edit_info"])) { 
					switch($row1['programme']) {
						case "Information Technology": ?>
							<td><select name="major"><option value="<?php echo $row1['major']; ?>" selected><?php echo $row1['major']; ?></option><option value="Information Management">Information Management</option><option value="Intelligent System">Intelligent System</option><option value="Computer Network">Computer Network</option><option value="Software Engineering">Software Engineering</option></select></td>
						<?php break;
						case "Business Administration": ?>
							<td><select name="major"><option value="<?php echo $row1['major']; ?>" selected><?php echo $row1['major']; ?></option><option value="Creative Media">Creative Media</option><option value="Applied Psychology">Applied Psychology</option><option value="Bank Management">Bank Management</option><option value="Corporate Communication">Corporate Communication</option></select></td>
						<?php break;
					}
				} else { ?>
					<td><?php echo $row1['major']; ?></td>
				<?php } ?>
			</tr>
			<?php } ?>
		</table>
		<?php if(isset($_POST["edit_info"])) { ?>
			<input type="submit" name="save_changes" value="Save changes">
			<input type="reset" value="Cancel">
		<?php } else { ?>
			<input type="submit" name="edit_info" value="Edit info">
			<a href="Changepassword.php"><input type="button" value="Change password"></a>
		<?php } ?>
	</form>
</body>
</html>