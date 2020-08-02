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
$zipcode = $_GET["zip"];
$rating = 0;
$gender1 = "'male'";
$gender2 = "'female'";
$wage = "1000";
try {
  if ($_GET["gender1"] != null) {
  $gender1 = $_GET["gender1"];
}
} catch (Error $e) { // this will catch only Errors
}

try {
  if ($_GET["gender2"] != null) {
  $gender2 = $_GET["gender2"];
}
} catch (Error $e) { // this will catch only Errors
}
try {
  if ($_GET["wage"] != null) {
  $wage= $_GET["wage"];
}
} catch (Error $e) { // this will catch only Errors
}



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
      $tsql1= "SELECT DISTINCT T.aid, T.fname, T.lname, T.edlevel, T.gender, T.wage, R.rating, A.city, T.zipcode
FROM Tutors T, AddressMapping A, TutorSubjects TSub, Ratings R
WHERE T.zipcode=A.zipcode AND R.aid=T.aid AND
T.zipcode IN (SELECT A2.zipcode
FROM AddressMapping A1, AddressMapping A2
WHERE A1.zipcode= ".$zipcode." AND A2.city=A1.city AND A2.stateName=A1.stateName)
AND (Tsub.aid = T.aid AND Tsub.subid >= 0 AND Tsub.subid <= 500)
AND T.wage <= ".$wage." AND (T.gender=".$gender1." OR T.gender=".$gender2.")";

      //$tsql1 = "SELECT TOP (10) * FROM [dbo].[Tutors]";
      //echo $tsql1;
      $getResults= sqlsrv_query($conn, $tsql1);
      if(!$getResults){
    	echo "<script>
    		alert('Some error occured');
    		</script>";
    		die(print_r(sqlsrv_errors(), true));
    	}
        $result['tutors'] = array();
      while($row = sqlsrv_fetch_array($getResults)){
        $result['numberOfEntries'] += 1;

        $aid = $row['aid'];
        if($aid==null){
          $aid = "";
        }

        $fname = $row['fname'];
        if($fname==null){
          $fname = "";
        }
      $lname = $row['lname'];
        if($lname==null){
          $lname = "";
        }
        $edlevel = $row['edlevel'];
        if($edlevel==null){
          $edlevel = "";
        }
      $wage = $row['wage'];
        if($wage==null){
          $wage = "";
        }
        $city = $row['city'];
          if($city==null){
            $city = "";
          }

            $temp = array(
                "aid" => $aid,
                "fname" =>$fname,
                "lname" =>$lname,
                "edlevel" =>$edlevel,
                "wage" =>$wage,
                "city" =>$city
            );
            array_push($result["tutors"], $temp);
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
