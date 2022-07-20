<?php 
session_start();
require_once ('../process/dbh.php');
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
	<title>View Employee</title>
	<link rel="stylesheet" type="text/css" href="../css/styleview.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.37/jspdf.plugin.autotable.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>
</head>
<body>
	<header>
		<nav>
			<ul id="navli">
				<li><a class="homeblack" href="index.php">HOME</a></li>
				<li><a class="homeblack" href="addemp.php">Add Employee</a></li>
				<li><a class="homered" href="viewemp.php">View Employee</a></li>
				<li><a class="homeblack" href="assign.php">Assign Project</a></li>
				<li><a class="homeblack" href="assignproject.php">Project Status</a></li>
				<li><a class="homeblack" href="salaryemp.php">Salary Table</a></li>
				<li><a class="homeblack" href="empleave.php">Employee Leave</a></li>
				<li><a class="homeblack" href="../index.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	<div class="divider"></div>
		<br>
		  <input type="text" id="search" placeholder="Search">  <input type="button" value="Print" onclick="printDiv()" />
		 <button onclick="generateExcel()">Export to Excel</button>
		 <button onclick="generatePDF()">Export to PDF</button>
		<hr>
		<div id="responsecontainer">
		
	<script

	integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
	crossorigin="anonymous">
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$.ajax({   
			type: "GET",
			url: "../process/retrieveemployee.php",             
			dataType: "html",             
			success: function(response){                    
					$("#responsecontainer").html(response); 
				}	
			});
		});
	</script>
	<script>
	function printDiv() {
		var divToPrint=document.getElementById("table_with_data");
		newWin= window.open("");
		newWin.document.write(divToPrint.outerHTML);
		newWin.document.write("<style> td:nth-child(13){display:none;}th:nth-child(13){display:none;}</style>");
		newWin.print();
		newWin.close();
    }
	function generateExcel() {
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('table_with_data');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
	
		var a = document.createElement('a');
		a.href = data_type + ', ' + table_html;
		a.download = 'Example_Table_To_Excel.xls';
		a.click();
	}
	function generatePDF() {
	var doc = new jsPDF('l', 'pt');
	
	var elem = document.getElementById('table_with_data');
	
	var data = doc.autoTableHtmlToJson(elem);
	var columns = [
		data.columns[0], 
		data.columns[1],
		data.columns[2],
		data.columns[3],
		data.columns[4],
		data.columns[5],
		data.columns[6],
		data.columns[7],
		data.columns[8],
		data.columns[9],
		data.columns[10],
		data.columns[11]
	];
	doc.autoTable(columns , data.rows, {
		margin: {left: 35},
		theme: 'grid',
		tableWidth: 'auto',
		fontSize: 8,
		overflow: 'linebreak',
		}
	);
		
	doc.save('Example_Table_To_PDF.pdf');
	}
	</script>
	
</body>
</html>
<?php
}
else{
	echo "<script>window.location.href='../Forbidden.php';</script>";
}
?>