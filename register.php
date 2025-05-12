<?php
include('public/db_connect.php');

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error_message = "Username already taken. Please choose another one.";
    } else {
        $insert_query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ss", $username, $hashed_password);
        $insert_stmt->execute();
        
        header("Location: login.php");
        exit();
    }
}
?>

<!-- HTML PART -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Mind Mentor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f0f8ff; display:flex; justify-content:center; align-items:center; height:100vh;">
    <div class="card p-4" style="width:400px;">
        <h3 class="text-center text-primary">Registration</h3>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required/>
            </div>
            <input type="submit" value="Register" class="btn btn-primary btn-block"/>
        </form>
        <a href="login.php" class="d-block text-center mt-2">Already have an account? Login</a>
    </div>
</body>
</html>
