<?php
	require "Databaseconnect.php";
	$course_code = $_GET["course_code"];
	$matric = $_GET["student_matric"];
	$programme = $_GET["programme"];
	$q = "DELETE FROM dashboard WHERE course_code='$course_code' AND matric='$matric'";
	$r = mysqli_query($dbc, $q);
	if($r) {
		echo "<script>
			  window.alert('Successfully removed selected student\'s result');
			  window.location.href = 'Result.php?matric=".$matric."&programme=".$programme."';
			  </script>";
	}
	else {
		die(mysqli_error($dbc));
	}
?>