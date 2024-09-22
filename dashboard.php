<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in first.'); window.location.href = 'login.html';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <style>
        body {
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand {
            color: white;
        }
        .dashboard-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 20px;
        }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        
        <a class="navbar-brand" href="#">
            <img src="./assets/Images/logo.png" alt="logo" width="60px" height="30" class="d-inline-block align-text-top">
            WiseWish
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="dashboard-container">
    <h1 class="text-center">Welcome, <?php echo $_SESSION['full_name']; ?>!</h1>
    <p class="text-center">You are logged in as user ID: <?php echo $_SESSION['user_id']; ?></p>

    
    <div class="row mt-4">
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Profile</h5>
                    <p class="card-text">View and edit your profile details.</p>
                    <a href="profile.php" class="btn btn-primary">Go to Profile</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Study Resources</h5>
                    <p class="card-text">Access your personalized study resources.</p>
                    <a href="studyres.html" class="btn btn-primary">View Resources</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Tools</h5>
                    <p class="card-text">Check out amazing tools offered by WiseWish.</p>
                    <a href="scholarships.php" class="btn btn-primary">View Tools</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="logout.php" class="btn logout-btn">Logout</a>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
