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
	li a:hover, li:nth-child(3) {
		background-color: #111;
	}
	div.form {
		text-align: center;
	}
	form {
		display: inline-block;
		text-align: left;
		background-color: lightgrey;
		padding: 12px 80px;
	}
	input {
		padding: 6px 10px;
		margin: 8px 0;
		border: 2px solid dodgerblue;
		border-radius: 4px;
	}
	input[type=submit] {
		background-color: dodgerblue;
		color: white;
	}
</style>
<?php
	session_start();
	$dbc = mysqli_connect("localhost", "root", "", "online_bookstore") OR die(mysqli_connect_error());
	mysqli_set_charset($dbc, "utf-8");
	$username = $_SESSION["username"];
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$r = mysqli_query($dbc, "DELETE FROM shopping_cart WHERE username='$username'");
		if($r) {
			echo "<script>
				  window.alert('Successfully checkout');
				  window.location.href = 'Shoppingcart.php';
				  </script>";
		}
		else {
			die(mysqli_error($dbc));
		}
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
			<li><a>Shopping Cart</a></li>
			<li><a href="Myaccount.php">My Account</a></li>
			<li style="float:right"><a href="Logout.php">Logout</a></li>
		<?php } ?>
		<li style="float:right"><?php if(isset($_SESSION['username'])) {echo "Welcome, ".$_SESSION['username'];} ?></li>
	</ul>
	<h2>CHECKOUT</h2>
	<div class="form">
		<form action="Checkout.php" method="post">
			<b>Credit card channel</b><br>
			<pre><input type="radio" name="creditcard" checked> VISA	<input type="radio" name="creditcard"> Mastercard	<input type="radio" name="creditcard"> Amex</pre>
			<br>
			<br>
			<b>CVV code</b><br>
			<input type="password" oninput="javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" autocomplete="off" required>
			<br>
			<br>
			<input type="submit" value="Checkout">
		</form>
	</div>
</body>
</html>