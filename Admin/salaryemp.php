<?php
session_start();
require_once ('../process/dbh.php');
$sql = "SELECT users.id,users.firstName,users.lastName,salary.base,salary.bonus,salary.total from users,`salary` where users.id=salary.id";

//echo "$sql";
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
	<title>Salary Table</title>
	<link rel="stylesheet" type="text/css" href="../css/styleview.css">
</head>
<body>
	
	<header>
		<nav>
			<ul id="navli">
				<li><a class="homeblack" href="aloginwel.php">HOME</a></li>
				
				<li><a class="homeblack" href="index.php">Add Employee</a></li>
				<li><a class="homeblack" href="viewemp.php">View Employee</a></li>
				<li><a class="homeblack" href="assign.php">Assign Project</a></li>
				<li><a class="homeblack" href="assignproject.php">Project Status</a></li>
				<li><a class="homered" href="salaryemp.php">Salary Table</a></li>
				<li><a class="homeblack" href="empleave.php">Employee Leave</a></li>
				<li><a class="homeblack" href="../index.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
		
	</div>
	<br>
	<table>
			<tr>
				<th align = "center">Emp. ID</th>
				<th align = "center">Name</th>
				
				
				<th align = "center">Base Salary</th>
				<th align = "center">Bonus</th>
				<th align = "center">TotalSalary</th>
				
				
			</tr>
			
			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['base']."</td>";
					echo "<td>".$employee['bonus']." %</td>";
					echo "<td>".$employee['total']."</td>";
					
					

				}


			?>
			
			</table>
</body>
</html>
<?php
}
else{
	echo "<script>window.location.href='../Forbidden.php';</script>";
}
?>