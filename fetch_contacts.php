<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);

$contacts = array();

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $contacts[] = $row;
    }
}


echo json_encode($contacts);


$conn->close();
?>
