<?php 
session_start();
require_once ('../process/dbh.php');
$sql = "SELECT id, firstName, lastName,  points FROM users, rank WHERE rank.eid = users.id order by rank.points desc";
$result = mysqli_query($conn, $sql);

if(isset($_SESSION["id"])){
	$dbid = $_SESSION["id"];
	$get_record = mysqli_query($conn, "SELECT * FROM users WHERE id = '$dbid'");
	$row = mysqli_fetch_assoc($get_record);
	$dbstatus = $row["dbstatus"];
	if($dbstatus != "1"){
		echo "<script>window.location.href='../Forbidden'</script>";
	}	
?>


<html>
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="../css/styleemplogin.css">
</head>
<body>
	
	<header>
		<nav>
			<ul id="navli">
				<li><a class="homered" href="aloginwel.php">HOME</a></li>
				<li><a class="homeblack" href="addemp.php">Add Employee</a></li>
				<li><a class="homeblack" href="viewemp.php">View Employee</a></li>
				<li><a class="homeblack" href="assign.php">Assign Project</a></li>
				<li><a class="homeblack" href="assignproject.php">Project Status</a></li>
				<li><a class="homeblack" href="salaryemp.php">Salary Table</a></li>
				<li><a class="homeblack" href="empleave.php">Employee Leave</a></li>
				<li><a class="homeblack" href="../logout.php">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
		<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Empolyee Leaderboard </h2>
    	<table>

			<tr bgcolor="#000">
				<th align = "center">Seq.</th>
				<th align = "center">Emp. ID</th>
				<th align = "center">Name</th>
				<th align = "center">Points</th>
				

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$seq."</td>";
					echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['points']."</td>";
					
					$seq+=1;
				}


			?>

		</table>

		<div class="p-t-20">
			<button class="btn btn--radius btn--submit" type="submit" style="float: right; margin-right: 60px"><a href="reset.php" style="text-decoration: none; color: white"> Reset Points</button>
		</div>

		
	</div>
</body>
</html>

<?php
}
else{
	echo "<script>window.location.href='../Forbidden.php';</script>";
}

?>