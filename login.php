<?php
session_start();
include('public/db_connect.php');

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: http://localhost/mind-mentor/public/index.php"); // Correct path
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Invalid username.";
    }
}
?>

<!-- HTML PART -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Mind Mentor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f0f8ff; display:flex; justify-content:center; align-items:center; height:100vh;">
    <div class="card p-4" style="width:400px;">
        <h3 class="text-center text-primary">Login</h3>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required/>
            </div>
            <input type="submit" value="Login" class="btn btn-primary btn-block"/>
        </form>
        <a href="register.php" class="d-block text-center mt-2">Don't have an account? Register here</a>
    </div>
</body>
</html>
