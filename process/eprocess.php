<?php
session_start();
 require_once ('dbh.php');

 	// if(isset($_SESSION["id"])){
	// 		$dbid = $_SESSION["id"];
	// 		$get_record = mysqli_query($con, "SELECT * FROM users WHERE id = '$dbid'");
	// 		$row = mysqli_fetch_assoc($get_record);
	// 		$dbtype = $row["dbstatus"];
	// 		if($dbtype == "0"){
	// 			echo "<script>window.location.href='../Employee'</script>";
	// 		}
	// 		else{
	// 			echo "<script>window.location.href='../Admin'</script>";
	// 		}
	// 	}
	// else{
		
	// }

// $email = $_POST['mailuid'];
// $password = $_POST['pwd'];

// $sql = "SELECT * from `employee` WHERE email = '$email' AND password = '$password'";
// $sqlid = "SELECT id from `employee` WHERE email = '$email' AND password = '$password'";

// $result = mysqli_query($conn, $sql);
// $id = mysqli_query($conn , $sqlid);

// $empid = "";
// if(mysqli_num_rows($result) == 1){
	
// 	$employee = mysqli_fetch_array($id);
// 	$empid = ($employee['id']);
	

// 	//echo ("logged in");
// 	//echo ("$empid");
	
// 	header("Location: ../eloginwel.php?id=$empid");
// }

// else{
	
// }

$email = $password = "";

$emailErr = $passwordErr = "";

if(isset($_POST['login-submit'])){
	if(empty($_POST['mailuid'])){

	}
	else{
		$email = $_POST['mailuid'];
	}
	if(empty($_POST['pwd'])){
	
	}
	else{
		$password = $_POST['pwd'];
	}

	if(!empty($email && $password)){
		$sql = mysqli_query($conn, "SELECT * from `users` WHERE email = '$email'");
		$checkdb = mysqli_num_rows($sql);
		if($checkdb > 0){
				while($row = mysqli_fetch_assoc($sql)){
					$dbid = $row['id'];
					$dbstatus = $row['dbstatus'];
					$dbpass = $row['password'];
					$dbemail = $row['email'];

					if($password == $dbpass AND $email == $dbemail AND $dbstatus == "1"){
						$_SESSION['id'] = $dbid;
						echo "<script>window.location.href='../Admin'</script>";
					}
					elseif($password == $dbpass AND $email == $dbemail AND $dbstatus == "0"){
						$_SESSION['id'] = $dbid;
						echo "<script>window.location.href='../Employee'</script>";
					}
					else{
						echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Invalid email and password')
						window.location.href='javascript:history.go(-1)';
						</SCRIPT>");
						echo "<script>window.location.href='../index.php'</script>";
					}
			}
		}
	
	}	
}
?>