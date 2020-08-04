<!DOCTYPE html>
<html>
<head>
    <title>Interview Test</title>
</head>
<!--Sorting user input ordered by uppercase letter, lowercase letter, number and others with refreshing page-->
<?php
    $input = ""; $uppercase = ""; $lowercase = ""; $number = ""; $others = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = $_POST["input"];
    }
    $characters = str_split($input);
    for($i = 0; $i < sizeof($characters); $i++) {
        if(ctype_upper($characters[$i])) {
            $uppercase = $uppercase.$characters[$i];
        }
        else if(ctype_lower($characters[$i])) {
            $lowercase = $lowercase.$characters[$i];
        }
        else if(is_numeric($characters[$i])) {
            $number = $number.$characters[$i];
        }
        else {
            $others = $others.$characters[$i];
        }
    }
    $split_uppercase = str_split($uppercase);
    sort($split_uppercase);
    $uppercase = implode($split_uppercase);
    $split_lowercase = str_split($lowercase);
    sort($split_lowercase);
    $lowercase = implode($split_lowercase);
    $split_number = str_split($number);
    sort($split_number);
    $number = implode($split_number);
    $output = $uppercase.$lowercase.$number.$others;
?>
<body>
    <form method="post">
	<label>Input here: </label>
        <input type="text" name="input">
	<input type="submit" value="Submit">
        <br>
        <label><?php if($output != "") {echo "Output: ".$result;} ?></label>
    </form>
</body>
</html>