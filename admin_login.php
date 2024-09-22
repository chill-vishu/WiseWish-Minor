<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT password FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        
        if (password_verify($input_password, $hashed_password)) {
            $_SESSION['admin'] = $input_username;
            header("Location: admin_dashboard.html");
            exit();
        } else {
            echo "<script>alert('Invalid credentials.'); window.location.href = 'admin.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials.'); window.location.href = 'admin.html';</script>";
    }

    $stmt->close();
}


$conn->close();
?>
