<?php 
session_start();
require_once ('../process/dbh.php');
	if(isset($_SESSION["id"])){
		$id = $_SESSION["id"];
		$get_record = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
		$row = mysqli_fetch_assoc($get_record);
		$dbstatus = $row["dbstatus"];
			if($dbstatus != "0"){
				echo "<script>window.location.href='../Forbidden'</script>";
			}	
	
		$sql1 = "SELECT * FROM `users` where id = '$id'";
		$result1 = mysqli_query($conn, $sql1);
		$employeen = mysqli_fetch_array($result1);
		$empName = ($employeen['firstName']);

		$sql = "SELECT id, firstName, lastName,  points FROM users, rank WHERE rank.eid = users.id order by rank.points desc";
		$sql1 = "SELECT `pname`, `duedate` FROM `project` WHERE eid = $id and status = 'Due'";

		$sql2 = "Select * From users, employee_leave Where users.id = $id and employee_leave.id = $id order by employee_leave.token";

		$sql3 = "SELECT * FROM `salary` WHERE id = $id";

		//echo "$sql";
		$result = mysqli_query($conn, $sql);
		$result1 = mysqli_query($conn, $sql1);
		$result2 = mysqli_query($conn, $sql2);
		$result3 = mysqli_query($conn, $sql3);
?>
<html>
<head>
	<title>Employee Panel</title>
	<link rel="stylesheet" type="text/css" href="../css/styleemplogin.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat" rel="stylesheet">
</head>
<body>
	
	<header>
		<nav>
			<ul id="navli">
				<li><a class="homered" href="index.php?id=<?php echo $id?>">HOME</a></li>
				<li><a class="homeblack" href="myprofile.php?id=<?php echo $id?>">My Profile</a></li>
				<li><a class="homeblack" href="empproject.php?id=<?php echo $id?>">My Projects</a></li>
				<li><a class="homeblack" href="applyleave.php?id=<?php echo $id?>">Apply Leave</a></li>
				<li><a class="homeblack" href="../logout.php">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
	<div>
		<!-- <h2>Welcome <?php echo "$empName"; ?> </h2> -->

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
    	<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Due Projects</h2>
    	<table>
			<tr>
				<th align = "center">Project Name</th>
				<th align = "center">Due Date</th>
			</tr>
			<?php
				while ($employee1 = mysqli_fetch_assoc($result1)) {
					echo "<tr>";
					echo "<td>".$employee1['pname']."</td>";
					echo "<td>".$employee1['duedate']."</td>";
				}
			?>
		</table>
		<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Salary Status</h2>
    	<table>
			<tr>
				<th align = "center">Base Salary</th>
				<th align = "center">Bonus</th>
				<th align = "center">Total Salary</th>
			</tr>
			<?php
				while ($employee = mysqli_fetch_assoc($result3)) {
					echo "<tr>";
					echo "<td>".$employee['base']."</td>";
					echo "<td>".$employee['bonus']." %</td>";
					echo "<td>".$employee['total']."</td>";
				}
			?>
		</table>

		<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Leave Satus</h2>
    	<table>
			<tr>
				<th align = "center">Start Date</th>
				<th align = "center">End Date</th>
				<th align = "center">Total Days</th>
				<th align = "center">Reason</th>
				<th align = "center">Status</th>
			</tr>
			<?php
				while ($employee = mysqli_fetch_assoc($result2)) {
					$date1 = new DateTime($employee['start']);
					$date2 = new DateTime($employee['end']);
					$interval = $date1->diff($date2);
					$interval = $date1->diff($date2);
					echo "<tr>";
					echo "<td>".$employee['start']."</td>";
					echo "<td>".$employee['end']."</td>";
					echo "<td>".$interval->days."</td>";
					echo "<td>".$employee['reason']."</td>";
					echo "<td>".$employee['status']."</td>";
				}
			?>
		</table>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
		</h2>
	</div>
</body>
</html>
<?php
}
else{
	echo "<script>window.location.href='../Forbidden.php';</script>";
}

?>
