<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";


session_start();


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT id, full_name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    
    $stmt->execute();
    $stmt->store_result();
    
    
    if ($stmt->num_rows > 0) {
        
        $stmt->bind_result($user_id, $full_name, $hashed_password);
        $stmt->fetch();

        
        if (password_verify($password, $hashed_password)) {
            
            $_SESSION['user_id'] = $user_id;
            $_SESSION['full_name'] = $full_name;

           
            echo "<script>alert('Login successful! Redirecting...'); window.location.href = 'dashboard.php';</script>";
        } else {
         
            echo "<script>alert('Invalid password! Please try again.'); window.location.href = 'login.html';</script>";
        }
    } else {
       
        echo "<script>alert('Email not found! Please try again or sign up.'); window.location.href = 'login.html';</script>";
    }

 
    $stmt->close();
    $conn->close();
}
?>
