<?php
// Include database connection
include('db_connect_mentors.php');

// Fetch mentors data from the database
$query = "SELECT * FROM mentors";
$result = $conn->query($query);

// Check if there are any mentors
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         echo '<div class="mentor">';
//         echo '<img src="' . $row['photo_url'] . '" alt="' . $row['name'] . '">';
//         echo '<h3>' . $row['name'] . '</h3>';
//         echo '<p>' . $row['profession'] . '</p>';
//         echo '<a href="' . $row['connect_link'] . '" target="_blank">Connect</a>';
//         echo '</div>';
//     }
// } else {
//     echo 'No mentors found.';
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Mentors - Mind Mentor</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
        }
        .header {
            background-color: white;
            color: black;
            padding: 20px;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
        }
        .mentor-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            gap: 20px;
        }
        .mentor-card {
            background: white;
            border-radius: 15px;
            width: 250px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            text-align: center;
            transition: transform 0.3s;
        }
        .mentor-card:hover {
            transform: scale(1.05);
        }
        .mentor-card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .mentor-info {
            padding: 15px;
        }
        .mentor-info h3 {
            margin: 10px 0 5px 0;
            font-size: 22px;
            color: #333;
        }
        .mentor-info p {
            margin: 5px 0;
            font-size: 16px;
            color: #777;
        }
        .mentor-info a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color:rgb(77, 77, 229);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .mentor-info a:hover {
            background-color: white
        }
        .footer {
            margin-top: 40px;
            background: #3b5998;
            padding: 15px;
            color: white;
            text-align: center;
        }
        .navbar {
        background-color: #3b5998;
        padding: 0  30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .logo-text {
        font-size: 1.8rem;
        font-weight: 700;
      color: #ffffff;
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

    

    </style>
</head>
<body>
<nav class="navbar">
    <h1 class="logo-text">MindMentor</h1>
    <div class="nav-links">
      <a href="/mind-mentor/public/index.php">Home</a>
    </div>
  </nav>

    <div class="header">
        Meet Your Mentors
    </div>

    <div class="mentor-container">
        <?php
        if ($result->num_rows > 0) {
            while($mentor = $result->fetch_assoc()) {
                echo "<div class='mentor-card'>
                        <img src='" . htmlspecialchars($mentor['photo_url']) . "' alt='Mentor Photo'>
                        <div class='mentor-info'>
                            <h3>" . htmlspecialchars($mentor['name']) . "</h3>
                            <p>" . htmlspecialchars($mentor['profession']) . "</p>
                            <a href='" . htmlspecialchars($mentor['connect_link']) . "' target='_blank'>Connect</a>
                        </div>
                      </div>";
            }
        } else {
            echo "<p>No mentors available at the moment.</p>";
        }
        ?>
    </div>

    <div class="footer">
        © 2025 Mind Mentor | Connecting Students with Experts
    </div>

</body>
</html>