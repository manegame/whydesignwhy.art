<?php

function breakOut ($response) {
  echo json_encode($response);
  die();
}

// 
// 
// PREPARE RESPONSE FORMAT
$response = array();

//
//
// DB INFORMATION
$servername = "localhost";
$username   = "manuswx118_hielkema";
$password   = "ts11nt78";
$dbname     = "manuswx118_hielkema";

// 
// 
// START GET

// if ($_SERVER['REQUEST_METHOD'] == 'GET') {

//   // 
//   // 
//   // CREATE CONNECTION
//   $conn = new mysqli($servername, $username, $password, $dbname);

//   // 
//   // 
//   // CHECK CONNECTION
//   if ($conn->connect_error) {
//     $response["error"] = $conn->connect_error;
//     $response["status"] = "connection_error";
//     breakOut($response);
//   }

//   // 
//   // 
//   // GET AMOUNT OF VOTES
//   $sqlVotes = "SELECT COUNT(CASE WHEN `Answer` = 1 THEN 1 END) AS yesVotes, COUNT(CASE WHEN `Answer` = 0 THEN 1 END) AS noVotes FROM `Senegal`";
//   $sqlVotes = $conn->query($sqlaverage, MYSQLI_USE_RESULT);
  
//   if ($result = $conn->query($sqlVotes)) {
//     echo $result;

//     $result->close();
//   }

//   // 
//   // 
//   // CLOSE CONNECTION
//   $conn->close();
  
// }

// END GET
// 
// 

// 
// 
// START POST

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // 
  // 
  // PREPARE RESPONSE FORMAT
  $response = array();

  // 
  // 
  // GET INPUT DATA
  $data     = file_get_contents('php://input');
  $decoded  = json_decode($data, true);

  // 
  // 
  // ASSIGN DATA
  $ip       = $_SERVER['REMOTE_ADDR'];
  $answer   = $decoded['answer'];

  // 
  // 
  // INPUT SANITIZATION

  // IP
  if (!filter_var($ip, FILTER_VALIDATE_IP)) {
    $response["error"] = "Input error: Invalid IP";
    $response["status"] = "input_error";
    breakOut($response);
  }

  // Answer
  if (!filter_var($answer, FILTER_VALIDATE_INT)) {
    $response["error"] = "Input error: Invalid answer";
    $response["status"] = "input_error";
    breakOut($response);
  }

  // 
  // 
  // CREATE CONNECTION
  $conn = new mysqli($servername, $username, $password, $dbname);

  // 
  // 
  // CHECK CONNECTION
  if ($conn->connect_error) {
    $response["error"] = $conn->connect_error;
    $response["status"] = "connection_error";
    breakOut($response);
  }


  // 
  // 
  // CHECK IP
  $sqlIp = "SELECT ip FROM `Senegal` WHERE ip = '".$ip."'";

  if ($result = $conn->query($sqlIp)) {
    if ($result->num_rows > 0) {
      $response["error"] = "Vote already cast!";
      $response["status"] = "duplicate_vote";
      // breakOut($response);
    }

    $result->close();
  }

  $conn->next_result();


  // 
  // 
  // INSERT VALUES INTO DB IF NOT ALREADY VOTED

  if ($response["status"] !== "duplicate_vote") {

    $sqlPost = "INSERT INTO `Senegal` (id, Answer, ip) VALUES ('', '".$answer."', '".$ip."')";
  
    if ($conn->query($sqlPost) === TRUE) {
      $response["status"] = "new_record";
    } else {
      $response["error"] = $conn->error;
      $response["status"] = "connection_error";
      breakOut($response);
    }
  
    /* no need to free result set because there is none */

  }


  // 
  // 
  // GET AMOUNT OF VOTES YES AND NO
  $sqlVotes = "SELECT COUNT(CASE WHEN `Answer` = 1 THEN 1 END) AS yesVotes, COUNT(CASE WHEN `Answer` = 0 THEN 1 END) AS noVotes FROM `Senegal`";

  if ($result = $conn->query($sqlVotes)) {

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response["yes"] = $row['yesVotes'];
        $response["no"] = $row['noVotes'];
        $response["total"] = $row['yesVotes'] + $row["noVotes"];
    } else {
        $response["error"] = "Something went wrong";
    }

    breakOut($response);

    $result->close();
  }

  // 
  // 
  // CLOSE CONNECTION
  $conn->close();

} else {

  echo "NO POST, NO GET";

}

?>