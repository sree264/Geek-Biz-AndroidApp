<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


<?php

$zipcode = $_POST['zip'];

//echo $city . "--" . $country . "--" . $aid . "--" . $atype . "--" . $fname . "--" . $lname . "--" . $email . "--" . $phone . "--" . $dob . "--" . $gender . "--" .
//      $wage . "--" . $edlevel . "--" . $zipcode . "--" . $address1 . "--" . $address2 . "--" . $password;
$connectionInfo = array("UID" => "bkk48", "pwd" => "Cse541project", "Database" => "tutorsandstudents-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:geekbiz.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if(!$conn) {
	echo "<script>
	 alert('Connection failed');
	 </script>";
}
echo "<h2>Tutors</h2>";
echo "<table class='table'>
<tr>
	<th scope='col'>First name</th>
	<th scope='col'>Last name</th>
	<th scope='col'>Ed level</th>
	<th scope='col'>Wage</th>
	<th scope='col'>City</th>
</tr>
	";

	$tsql1= "SELECT T.fname, T.lname, T.edlevel, T.wage, A.city
FROM [dbo].[Tutors] T, [dbo].[AddressMapping] A
WHERE T.zipcode=A.zipcode AND T.zipcode IN
(SELECT A2.zipcode FROM [dbo].[AddressMapping] AS A1, [dbo].[AddressMapping] AS A2
WHERE A1.zipcode= ".$zipcode." AND A2.city=A1.city AND A2.stateName=A1.stateName)";
	$getResults = sqlsrv_query($conn, $tsql1);
	if(!$getResults){
	echo "<script>
		alert('Some error occured');
		</script>";
		die(print_r(sqlsrv_errors(), true));
	}
	while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
		echo "<tr>".
				"<td>".$row['fname']."</td>".
				"<td>".$row['lname']."</td>".
				"<td>".$row['edlevel']."</td>".
				"<td>".$row['wage']."</td>".
				"<td>".$row['city']."</td>".
			"</tr>";
	}
	echo "</table>";


?>
</body>
</html>
