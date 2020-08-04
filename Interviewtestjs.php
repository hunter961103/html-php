<!DOCTYPE html>
<html>
<head>
    <title>Interview Test</title>
</head>
<!--Sorting user input ordered by uppercase letter, lowercase letter, number and others without refreshing page-->
<script>
    function sortInput() {
        var input = document.getElementById("input").value;
        var characters = input.split("");
        var uppercase = "", lowercase = "", number = "", others = "";
        for(var i = 0; i < characters.length; i++) {
            if(characters[i] === characters[i].toUpperCase() && characters[i] !== characters[i].toLowerCase()) {
                uppercase = uppercase + characters[i];
            }
            else if(characters[i] === characters[i].toLowerCase() && characters[i] !== characters[i].toUpperCase()) {
                lowercase = lowercase + characters[i];
            }
            else if(!isNaN(characters[i])) {
                number = number + characters[i];
            }
            else {
                others = others + characters[i];
            }
        }
        var split_uppercase = uppercase.split("");
        var sort_uppercase = split_uppercase.sort();
        uppercase = sort_uppercase.join("");
        var split_lowercase = lowercase.split("");
        var sort_lowercase = split_lowercase.sort();
        lowercase = sort_lowercase.join("");
        var split_number = number.split("");
        var sort_number = split_number.sort();
        number = sort_number.join("");
        document.getElementById("output").innerHTML = "Output: " + uppercase + lowercase + number + others;
    }
</script>
<body>
    <form method="post">
	<label>Input here: </label>
        <input type="text" id="input">
	<input type="button" value="Submit "onclick="sortInput()">
        <br>
        <label id="output"></label>
    </form>
</body>
</html>