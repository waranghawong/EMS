<?php 
session_start();
require_once ('../process/dbh.php');

if(isset($_SESSION["id"])){
	$dbid = $_SESSION["id"];
	$get_record = mysqli_query($conn, "SELECT * FROM users WHERE id = '$dbid'");
	$row = mysqli_fetch_assoc($get_record);
	$dbstatus = $row["dbstatus"];
		if($dbstatus != "0"){
		echo "<script>window.location.href='../Forbidden'</script>";
		}	
		
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$sql = "SELECT * FROM `project` where eid = '$id'";
	$result = mysqli_query($conn, $sql);
	
?>



<html>
<head>
	<title>Employee Panel</title>
	<link rel="stylesheet" type="text/css" href="../css/styleview.css">
</head>
	<body>
	<header>
		<nav>
			<ul id="navli">
				<li><a class="homeblack" href="index.php?id=<?php echo $id?>">HOME</a></li>
				<li><a class="homeblack" href="myprofile.php?id=<?php echo $dbid?>">My Profile</a></li>
				<li><a class="homered" href="empproject.php?id=<?php echo $id?>">My Projects</a></li>
				<li><a class="homeblack" href="applyleave.php?id=<?php echo $id?>">Apply Leave</a></li>
				<li><a class="homeblack" href="../logout.php">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
	<br>
		<table>
			<tr>
				<th align = "center">Project ID</th>
				<th align = "center">Project Name</th>
				<th align = "center">Due Date</th>
				<th align = "center">Sub Date</th>
				<th align = "center">Mark</th>
				<th align = "center">Status</th>
				<th align = "center">Option</th>
			</tr>
			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['pid']."</td>";
					echo "<td>".$employee['pname']."</td>";
					echo "<td>".$employee['duedate']."</td>";
					echo "<td>".$employee['subdate']."</td>";
					echo "<td>".$employee['mark']."</td>";
					echo "<td>".$employee['status']."</td>";
					echo "<td><a href=\"psubmit.php?pid=$employee[pid]&id=$employee[eid]\">Submit</a>";
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