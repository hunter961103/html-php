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
		$semester = test_input($_POST["semester"]);
		$grade = test_input($_POST["grade"]);
		$student_matric = test_input($_POST["student_matric"]);
		$programme = test_input($_POST["programme"]);
		$grade_point = "";
		$status = "taking";
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
		$q = "UPDATE dashboard SET course_code='$course_code', semester='$semester', grade='$grade', grade_point='$grade_point', status='$status' WHERE course_code='$course_code' AND matric='$student_matric'";
		$r = mysqli_query($dbc, $q);
		if($r) {
			echo "<script>
				  window.alert('Successfully updated selected student\'s result');
				  window.location.href = 'Result.php?matric=".$student_matric."&programme=".$programme."';
				  </script>";
		}
		else {
			die(mysqli_error($dbc));
		}
	}
?>