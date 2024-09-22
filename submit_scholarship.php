<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $applicant_name = $_POST['applicantName'];
    $applicant_email = $_POST['applicantEmail'];
    $institution = $_POST['institution'];
    $gpa = $_POST['gpa'];
    $personal_statement = $_POST['personalStatement'];

    
    $sql = "INSERT INTO scholarship_applications (applicant_name, applicant_email, institution, gpa, personal_statement) 
            VALUES ('$applicant_name', '$applicant_email', '$institution', '$gpa', '$personal_statement')";

    
    if ($conn->query($sql) === TRUE) {
        
        echo "<script>
            alert('Application submitted successfully!');
            window.location.href = 'studyres.html'; // Redirect to the study resources page
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>
