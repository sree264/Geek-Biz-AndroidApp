<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$connectionInfo = array("UID" => "bkk48", "pwd" => "Cse541project", "Database" => "tutorsandstudents-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:geekbiz.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
// Create connection
//$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn) {
	echo "<script>
	 alert('Connection failed');
	 </script>";
}

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'),true);
$result = array();

$tutid = $_GET["tutid"];
$slotid = $_GET["slotid"];
$studid = $_GET["studid"];

function message_and_code($message, $code){
    $temp = array();
    $temp["message"] = $message;
    http_response_code($code);
    echo json_encode($temp);
}

switch ($method) {
    case 'GET':
    	$result['numberOfEntries'] = 0;
      //echo $_GET["username"];
      $tsql1 = "INSERT INTO [dbo].[Bookings]
      VALUES (".$tutid.", ".$slotid.", ".$studid.")";
      //$tsql1 = "SELECT TOP (10) * FROM [dbo].[Tutors]";
      //echo $tsql1;
      $getResults= sqlsrv_query($conn, $tsql1);
      if(!$getResults){
        echo "<script>
      		alert('Some error occured');
      		</script>";
      		die(print_r(sqlsrv_errors(), true));
    	  message_and_code("Some error occured",200);
    	}else{
            message_and_code("Booking Confirmed",200);
        }
        break;
        mysqli_close($conn);
  }
