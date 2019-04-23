<?php
	require "Databaseconnect.php";
	$course_code = $_GET["course_code"];
	$q = "DELETE FROM courses WHERE course_code='$course_code'";
	$r = mysqli_query($dbc, $q);
	if($r) {
		echo "<script>
			  window.alert('Successfully removed selected course');
			  window.location.href = 'Dashboard.php';
			  </script>";
	}
	else {
		die(mysqli_error($dbc));
	}
?>