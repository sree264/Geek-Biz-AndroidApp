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
      $tsql1 = "SELECT aid,password FROM [dbo].[Students] WHERE aid=".$_GET["username"]."";
      //$tsql1 = "SELECT TOP (10) * FROM [dbo].[Tutors]";
      //echo $tsql1;
      $getResults= sqlsrv_query($conn, $tsql1);
      if(!$getResults){
    	echo "<script>
    		alert('Some error occured');
    		</script>";
    		die(print_r(sqlsrv_errors(), true));
    	}
        $result['user'] = array();
      while($row = sqlsrv_fetch_array($getResults)){
        $result['numberOfEntries'] += 1;
        $aid = $row['aid'];
        if($aid==null){
          $aid = "";
        }
      $password = $row['password'];
        if($password==null){
          $password = "";
        }
            $temp = array(
                "aid" =>$aid,
                "password" =>$password
            );
            array_push($result["user"], $temp);
      }

        if($result['numberOfEntries']==0){
            message_and_code("Some error occured",200);
        }
        else{
            http_response_code(200);
            echo json_encode($result);
        }
        break;
        mysqli_close($conn);
  }
