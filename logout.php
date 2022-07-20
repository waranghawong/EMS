<?php 
session_start();
include("../process/dbh.php");


$dbid = $_SESSION["id"];
$user_md5 = md5($dbid);

function rand_a( $length = 50){
	
	$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	$shuffled = substr( str_shuffle ($str), 0, $length);
	return $shuffled;
}
$shuffled_logout = rand_a(57);
unset($_SESSION['id']);
session_unset();
session_destroy();
echo "Logging out.... Please wait ...";
echo "<script>window.location.href='index.php?logout=$shuffled_logout&v_1=$user_md5';</script>";
exit();


?>