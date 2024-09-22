<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in first.'); window.location.href = 'login.html';</script>";
    exit();
}


$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT full_name, email, created_at, profile_photo FROM users WHERE id='$user_id'");

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
    $email = $row['email'];
    $created_at = $row['created_at'];
    $profile_photo = $row['profile_photo'];
} else {
    echo "User not found.";
    exit();
}


$achievements = $conn->query("SELECT * FROM achievements WHERE user_id='$user_id'");
$certificates = $conn->query("SELECT * FROM certificates WHERE user_id='$user_id'");
$languages = $conn->query("SELECT * FROM languages WHERE user_id='$user_id'");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['profile_photo'])) {
        $profile_photo = $_FILES['profile_photo'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($profile_photo["name"]);
        if (move_uploaded_file($profile_photo["tmp_name"], $target_file)) {
            $conn->query("UPDATE users SET profile_photo='$target_file' WHERE id='$user_id'");
        }
    }

    if (isset($_POST['achievement_name'])) {
        $achievement_name = $_POST['achievement_name'];
        $conn->query("INSERT INTO achievements (user_id, achievement_name) VALUES ('$user_id', '$achievement_name')");
    }

    if (isset($_POST['certificate_name'])) {
        $certificate_name = $_POST['certificate_name'];
        $conn->query("INSERT INTO certificates (user_id, certificate_name) VALUES ('$user_id', '$certificate_name')");
    }

    if (isset($_POST['language_name'])) {
        $language_name = $_POST['language_name'];
        $conn->query("INSERT INTO languages (user_id, language_name) VALUES ('$user_id', '$language_name')");
    }

    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #2C3E50;
            color: #ECF0F1;
        }
        .profile-container {
            margin-top: 50px;
        }
        .profile-sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            background-color: #34495E;
            padding: 20px;
            border-radius: 10px;
        }
        .profile-sidebar img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }
        .profile-sidebar h3 {
            margin-top: 10px;
            margin-bottom: 5px;
        }
        .profile-box {
            background-color: #34495E;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .profile-box h2 {
            margin-bottom: 20px;
        }
        .section-title {
            margin-bottom: 20px;
        }
        .section-content {
            background-color: #2C3E50;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">WiseWish</a>
        <form class="form-inline">
            <a href="logout.php" class="btn btn-outline-light">Logout</a>
        </form>
    </nav>

    <div class="container profile-container">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-sidebar text-center">
                    <img src="<?php echo $profile_photo; ?>" alt="Profile Photo">
                    <h3><?php echo $full_name; ?></h3>
                    <p><?php echo $email; ?></p>
                    <p>Account Created On: <?php echo date('F j, Y', strtotime($created_at)); ?></p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profile-box">
                    <h2>Achievements</h2>
                    <form action="profile.php" method="post">
                        <input type="text" name="achievement_name" class="form-control" placeholder="Add new achievement" required>
                        <button type="submit" class="btn btn-primary mt-2">Add Achievement</button>
                    </form>
                    <div class="section-content">
                        <?php
                        if ($achievements->num_rows > 0) {
                            while ($row = $achievements->fetch_assoc()) {
                                echo "<p>" . htmlspecialchars($row['achievement_name']) . "</p>";
                            }
                        } else {
                            echo "<p>No achievements found.</p>";
                        }
                        ?>
                    </div>
                </div>
                <div class="profile-box">
                    <h2>Certificates</h2>
                    <form action="profile.php" method="post">
                        <input type="text" name="certificate_name" class="form-control" placeholder="Add new certificate" required>
                        <button type="submit" class="btn btn-primary mt-2">Add Certificate</button>
                    </form>
                    <div class="section-content">
                        <?php
                        if ($certificates->num_rows > 0) {
                            while ($row = $certificates->fetch_assoc()) {
                                echo "<p>" . htmlspecialchars($row['certificate_name']) . "</p>";
                            }
                        } else {
                            echo "<p>No certificates found.</p>";
                        }
                        ?>
                    </div>
                </div>
                <div class="profile-box">
                    <h2>Languages Known</h2>
                    <form action="profile.php" method="post">
                        <input type="text" name="language_name" class="form-control" placeholder="Add new language" required>
                        <button type="submit" class="btn btn-primary mt-2">Add Language</button>
                    </form>
                    <div class="section-content">
                        <?php
                        if ($languages->num_rows > 0) {
                            while ($row = $languages->fetch_assoc()) {
                                echo "<p>" . htmlspecialchars($row['language_name']) . "</p>";
                            }
                        } else {
                            echo "<p>No languages found.</p>";
                        }
                        ?>
                    </div>
                </div>
                <div class="profile-box">
                    <h2>Upload Profile Photo</h2>
                    <form action="profile.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="profile_photo" class="form-control-file" required>
                        <button type="submit" class="btn btn-primary mt-2">Upload Photo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
