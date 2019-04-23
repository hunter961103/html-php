<?php
	session_start();
	require "Databaseconnect.php";
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$course_code = test_input($_POST["course_code"]);
		$course_name = test_input($_POST["course_name"]);
		$course_prerequisite = test_input($_POST["course_prerequisite"]);
		$course_type = test_input($_POST["course_type"]);
		$major = test_input($_POST["major"]);
		$q = "UPDATE courses SET course_code='$course_code', course_name='$course_name', course_prerequisite='$course_prerequisite', course_type='$course_type', major='$major' WHERE course_code='$course_code'";
		$r = mysqli_query($dbc, $q);
		if($r) {
			echo "<script>
				  window.alert('Successfully updated selected course');
				  window.location.href = 'Dashboard.php';
				  </script>";
		}
		else {
			die(mysqli_error($dbc));
		}
	}
?>