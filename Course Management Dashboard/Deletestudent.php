<?php
	require "Databaseconnect.php";
	$matric = $_GET["matric"];
	$q = "DELETE FROM users WHERE matric='$matric'";
	$r = mysqli_query($dbc, $q);
	$q1 = "DELETE FROM dashboard WHERE matric='$matric'";
	$r1 = mysqli_query($dbc, $q1);
	if($r && $r1) {
		echo "<script>
			  window.alert('Successfully removed selected student');
			  window.location.href = 'Studentinfo.php';
			  </script>";
	}
	else {
		die(mysqli_error($dbc));
	}
?>