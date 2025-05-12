<?php
// Start the session
session_start();

// Include the database connection
include('db_connect.php');

// Check if the user is already logged in, if so, redirect to the dashboard or AI chat
if (isset($_SESSION['user_id'])) {
    header("Location: ai_career_counseling.php");
    exit();
}

// Check if the login form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: ai_career_counseling.php");
        exit();
    } else {
        $error_message = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindMentor</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type='module' src='https://interfaces.zapier.com/assets/web-components/zapier-interfaces/zapier-interfaces.esm.js'></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }
        .navbar {
            background-color: #3b5998;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        .nav-links a {
            margin-left: 20px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        .nav-links a:hover {
            color: #000;
        }
        .logo-text {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
        }
        .hero {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(to right,white, #d2d2ff);
        }
        .hero h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }
        .quiz-button, .chat-button {
            display: inline-block;
            margin: 30px auto;
            background-color: #3b5998;
            padding: 15px 30px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            text-align: center;
            transition: background-color 0.3s, transform 0.3s;
        }
        .quiz-button:hover, .chat-button:hover {
            background-color: #8b8be0;
            transform: translateY(-3px);
        }
        .paragraph-text {
            max-width: 700px;
            margin: 30px auto;
            font-size: 1.1rem;
            text-align: center;
            color: #555;
        }
        .chat-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #4ade80;
            color: black;
        }
    </style>
</head>
<body>

    <div class="content">

        <!-- Navbar -->
        <nav class="navbar">
            <h1 class="logo-text">MindMentor</h1>
            <div class="nav-links">
                <a href="/mind-mentor/public/Roadmap/roadmap.html">Roadmap</a>
                <a href="/mind-mentor/public/About/about.html">About Us</a>
                <a href="/mind-mentor/public/Contact/contact.html">Contact Us</a>
                <a href="/mind-mentor/public/mentors.php">Mentors</a>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="hero">
            <h2>
                Choosing the right career shapes your future. <br>
                Discover your path with MindMentor.
            </h2>

            <!-- Quiz Button -->
            <a href="/mind-mentor/public/test/test/test.html" class="quiz-button">
                🎯 Take up a Quiz
            </a>

            <div class="paragraph-text">
                🤓 Take a quiz now;<br> Answering these questions will assist us in evaluating your career path more effectively.
            </div>
        </div>

        <!-- AI Chat Button -->
        <a href="/mind-mentor/public/ai/ai.html" class="chat-button">
            🤖 AI Chat
        </a>

        <!-- Login Form if not logged in -->
        <?php if (!isset($_SESSION['user_id'])): ?>
            <!-- Uncomment if you want to show login form here -->
            <!-- 
            <div class="login-container text-center mt-10">
                <h2 class="text-2xl font-semibold">Login</h2>
                <?php if (isset($error_message)) { echo "<p class='text-red-500 mt-2'>$error_message</p>"; } ?>
                <form method="POST" class="space-y-4 mt-6">
                    <input type="text" name="username" placeholder="Username" required class="border p-2 rounded w-64">
                    <input type="password" name="password" placeholder="Password" required class="border p-2 rounded w-64">
                    <button type="submit" name="login" class="bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600">Login</button>
                </form>
            </div>
            -->
        <?php endif; ?>

    </div>

</body>
</html>
