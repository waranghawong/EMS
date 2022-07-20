<?php 
session_start();
if(isset($_SESSION["id"])){
	$dbid = $_SESSION["id"];
	$get_record = mysqli_query($conn, "SELECT * FROM users WHERE id = '$dbid'");
	$row = mysqli_fetch_assoc($get_record);
	$dbstatus = $row["dbstatus"];
	if($dbstatus == "0"){
		echo "<script>window.location.href='Employee'</script>";
	}	
	else{
		echo "<script>window.location.href='Admin'</script>";
	}
}
 else{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" />
</head>
<body>
	<header>
		<nav>
			<ul id="navli">
				<li><a class="homeblack" href="index.php">User Login</a></li>
			</ul>
		</nav>
	</header>
	<div class="divider"></div>

	<div class="loginbox">
    <img src="assets/avatar.png" class="avatar">
        <h1>Login Here</h1>
        <form action="process/eprocess.php" method="POST">
            <p>Email</p>
            <input type="text" name="mailuid" placeholder="Enter Email Address" required="required">
            <p>Password</p>
            <input type="password" name="pwd" placeholder="Enter Password" required="required">
            <input type="submit" name="login-submit" value="Login">
        </form>
    </div>
			
			
</body>
</html>
<?php 
}
?>

