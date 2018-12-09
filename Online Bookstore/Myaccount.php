<!DOCTYPE html>
<html>
<head>
	<title>Online Bookstore</title>
</head>
<style>
	#background {
		background-image: url("http://eksentrika.com/wp-content/uploads/2018/08/2nd-slider-bg.jpg");
		opacity: 0.5;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-repeat: no-repeat;
		background-size: cover;
		z-index: -1;
	}
	h1 {
		background-color: darkslateblue;
		color: thistle;
		padding: 30px;
		margin: auto;
		display: flex;
		align-items: center;
		justify-content: center;
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
	li a:hover, li:nth-child(4) {
		background-color: #111;
	}
	form {
		width: 26%;
		margin: 0 auto;
	}
	table {
		border-collapse: collapse;
		margin: 0 auto;
	}
	td, th {
		border: 1px solid #ddd;
		padding: 8px;
		background-color: lightgrey;
	}
	th {
		padding-top: 12px;
		padding-bottom: 12px;
		padding-right: 50px;
		text-align: left;
	}
	input {
		padding: 6px 10px;
		margin: 8px 0;
		border: 2px solid dodgerblue;
		border-radius: 4px;
		background-color: dodgerblue;
		color: white;
	}
</style>
<?php
	session_start();
	$dbc = mysqli_connect("localhost", "root", "", "online_bookstore") OR die(mysqli_connect_error());
	mysqli_set_charset($dbc, "utf-8");
	$username = $_SESSION['username'];
	$q = "SELECT * FROM users WHERE username='$username'";
	$r = mysqli_query($dbc, $q);
	if($r) {
		$row = mysqli_fetch_array($r);
	}
	else {
		die(mysqli_error($dbc));
	}
?>
<body>
	<div id="background"></div>
	<h1><img src="https://ubisafe.org/images/transparent-logo-book-3.png" alt="" width="100" height="100" />ONLINE BOOKSTORE</h1>
	<ul>
		<li><a href="Home.php">Home</a></li>
		<li><a href="Booklist.php">Book List</a></li>
		<?php if(!isset($_SESSION['username'])) { ?>
			<li style="float:right"><a href="Login.php">Login</a></li>
		<?php }else{ ?>
			<li><?php if($_SESSION['user_type'] == "member") {echo "<a href='Shoppingcart.php'>Shopping Cart</a>";} ?></li>
			<li><a>My Account</a></li>
			<li style="float:right"><a href="Logout.php">Logout</a></li>
		<?php } ?>
		<li style="float:right"><?php if(isset($_SESSION['username'])) {echo "Welcome, ".$_SESSION['username'];} ?></li>
	</ul>
	<h2>MY ACCOUNT</h2>
	<form action="Myaccount.php" method="post">
		<table>
			<tr>
				<th>Username</th>
				<td><?php echo $row['username']; ?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $row['email']; ?></td>
			</tr>
			<tr>
				<th>Address</th>
				<td><?php echo $row['address']; ?></td>
			</tr>
			<tr>
				<th>Phone</th>
				<td><?php echo $row['phone']; ?></td>
			</tr>
		</table>
		<a href="Editaccount.php"><input type="button" value="Edit"></a>
	</form>
</body>
</html>