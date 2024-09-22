<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM scholarship_applications";
$result = $conn->query($sql);

$scholarships = array();

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $scholarships[] = $row;
    }
}


echo json_encode($scholarships);


$conn->close();
?>
