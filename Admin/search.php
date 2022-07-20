<?php
session_start();
require_once ('../process/dbh.php');
$sql = "SELECT * from `users` , `rank` WHERE employee.id = rank.eid";
$result = mysqli_query($conn, $sql);

if(!empty(isset($_POST['search']))) {
   $Name = $_POST['search'];

   $Query = "SELECT * FROM `users` , `rank` WHERE firstName LIKE '%$Name%' OR lastName LIKE '%$Name' and  users.id = rank.eid Group By lastName";
   $ExecQuery = MySQLi_query($conn, $Query);
    //echo mysqli_num_rows($ExecQuery);
?>
  <table>
			<tr>

				<th align = "center">Emp. ID</th>
				<th align = "center">Picture</th>
				<th align = "center">Name</th>
				<th align = "center">Email</th>
				<th align = "center">Birthday</th>
				<th align = "center">Gender</th>
				<th align = "center">Contact</th>
				<th align = "center">NID</th>
				<th align = "center">Address</th>
				<th align = "center">Department</th>
				<th align = "center">Degree</th>
				<th align = "center">Point</th>
				<th align = "center">Options</th>
			</tr>

			<?php
                 while ($Result = MySQLi_fetch_array($ExecQuery)) {
                   if(mysqli_num_rows($ExecQuery) >= 1){
                        echo "<tr>";
                        echo "<td>".$Result['id']."</td>";
                        echo "<td><img src='../process/".$Result['pic']."' height = 60px width = 60px></td>";
                        echo "<td>".$Result['firstName']." ".$Result['lastName']."</td>";
                        echo "<td>".$Result['email']."</td>";
                        echo "<td>".$Result['birthday']."</td>";
                        echo "<td>".$Result['gender']."</td>";
                        echo "<td>".$Result['contact']."</td>";
                        echo "<td>".$Result['nid']."</td>";
                        echo "<td>".$Result['address']."</td>";
                        echo "<td>".$Result['dept']."</td>";
                        echo "<td>".$Result['degree']."</td>";
                        echo "<td>".$Result['points']."</td>";
                        echo "<td><a href=\"edit.php?id=$Result[id]\">Edit</a> | <a href=\"delete.php?id=$Result[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                   }
                   else{
                    echo "<tr>";
                    echo "<td colspan='13'>No Result</td>";
                    echo "<tr>";
                   }
                }}
			?>
		</table>
  
