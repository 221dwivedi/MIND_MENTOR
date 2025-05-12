<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all necessary form fields are set
    if (isset($_POST['first_name'], $_POST['email'], $_POST['phone'], $_POST['education_level'], $_POST['board'], $_POST['city'], $_POST['gender'], $_POST['dob'], $_POST['stream'], $_POST['percentage'], $_POST['state'], $_POST['country'], $_POST['interests'], $_POST['career_goal'], $_POST['parent_name'], $_POST['parent_contact'])) {
        // Get form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $education_level = $_POST['education_level'];
        $board = $_POST['board'];
        $stream = $_POST['stream'];
        $percentage = $_POST['percentage'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $interests = $_POST['interests'];
        $career_goal = $_POST['career_goal'];
        $parent_name = $_POST['parent_name'];
        $parent_contact = $_POST['parent_contact'];

        // Insert form data into the database
        $query = "INSERT INTO students (first_name, last_name, gender, dob, email, phone, education_level, board, stream, percentage, city, state, country, interests, career_goal, parent_name, parent_contact) 
                  VALUES ('$first_name', '$last_name', '$gender', '$dob', '$email', '$phone', '$education_level', '$board', '$stream', '$percentage', '$city', '$state', '$country', '$interests', '$career_goal', '$parent_name', '$parent_contact')";
        
        if ($conn->query($query) === TRUE) {
            // Success - show Start Test button
            echo "
            <div style='text-align:center; margin-top:30px;'>
                <h2>Thank you, $first_name! Your information has been saved.</h2>
                <p>Click below to start your test:</p>
                <a href='test.php' style='
                    display:inline-block;
                    padding: 12px 25px;
                    background-color: #4CAF50;
                    color: white;
                    text-decoration: none;
                    font-size: 18px;
                    border-radius: 6px;
                    margin-top: 20px;
                '>Start Test</a>
            </div>
            ";
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Show form if not submitted yet
        echo "
        <div style='max-width:700px; margin:auto; padding:20px;'>
            <h2 style='text-align:center;'>Student Information Form</h2>
            <form method='POST' action='' style='margin-top:20px;'>
                <input type='text' name='first_name' placeholder='First Name' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='text' name='last_name' placeholder='Last Name' required style='width:100%; padding:10px; margin:8px 0;'>
                <select name='gender' required style='width:100%; padding:10px; margin:8px 0;'>
                    <option value='' disabled selected>Select Gender</option>
                    <option value='Male'>Male</option>
                    <option value='Female'>Female</option>
                    <option value='Other'>Other</option>
                </select>
                <input type='date' name='dob' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='email' name='email' placeholder='Email' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='text' name='phone' placeholder='Phone Number' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='text' name='education_level' placeholder='Education Level' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='text' name='board' placeholder='Board' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='text' name='stream' placeholder='Stream' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='text' name='percentage' placeholder='Percentage' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='text' name='city' placeholder='City' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='text' name='state' placeholder='State' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='text' name='country' placeholder='Country' required style='width:100%; padding:10px; margin:8px 0;'>
                <textarea name='interests' placeholder='Interests' required style='width:100%; padding:10px; margin:8px 0;'></textarea>
                <textarea name='career_goal' placeholder='Career Goal' required style='width:100%; padding:10px; margin:8px 0;'></textarea>
                <input type='text' name='parent_name' placeholder='Parent Name' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='text' name='parent_contact' placeholder='Parent Contact Number' required style='width:100%; padding:10px; margin:8px 0;'>
                <input type='submit' value='Submit & Continue to Test' style='
                    width:100%;
                    padding:12px;
                    background-color: #2196F3;
                    color:white;
                    border:none;
                    border-radius:5px;
                    font-size:16px;
                    margin-top:15px;
                    cursor:pointer;
                '>
            </form>
        </div>
        ";
    }
    
}
// Query to fetch all students' data from the database
$query = "SELECT * FROM students ORDER BY created_at DESC";
$result = $conn->query($query);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Career Guidance Form</title>
    <style>
        /* General Styles */
/* body {
    margin: 0;
    padding: 0;
    font-family: 'Roboto Flex', sans-serif;
    scroll-behavior: smooth;
    background: linear-gradient(135deg, #b3a3e1, #8c8cfd), url('https://www.transparenttextures.com/patterns/45-degree-fabric-light.png');
    background-size: cover;
    overflow-x: hidden; 
    
} */
body {
    margin-top: 20px;
    padding: 0;
    height: 100vh;
    background-image: url('public/About/books.jpg'); /* Replace with your image URL */
    background-size: cover; /* Ensures the image covers the entire screen */
    background-position: center; /* Centers the image */
    background-repeat: no-repeat; /* Avoids repeating the image */
    color: white; /* Ensures content is readable over the image */
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center; /* Centers the content horizontally */
    align-items: center; /* Centers the content vertically */
    text-align: center;
}
.content {
    background-color: rgba(0, 0, 0, 0.5); /* Adds a semi-transparent background for better text readability */
    padding: 20px;
    border-radius: 0px;
    margin-top: 0;
    
}

/* Navbar Styles */
.navbar {
    background-color: rgb(25, 25, 28); /* Dark navbar */
    height: 70px;
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    z-index: 1000;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    box-sizing: border-box; /* Ensure padding is included in width */
}

.logo-text {
    color: white;
    font-size: 50px;
    font-weight: 1000;
    margin: 0;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 20px;
}

.nav-links a {
    color: #fff;
    text-decoration: none;
    font-size: 20px;
    font-weight: bold;
    transition: color 0.3s, border-bottom 0.3s;
    position: relative;
}

.nav-links a:hover {
    color: #ffd700;
}

.nav-links a:hover::after {
    content: '';
    display: block;
    width: 100%;
    height: 5px;
    background-color: #ffd700;
    position: absolute;
    bottom: -10px;
    left: 0;
    border-radius: 5px;
}

/* Main Content Styles */
main {
    margin-top: 70px; /* Space for fixed navbar */
    padding: 20px;
    text-align: left;
    
}

.main-body-text {
    margin: 100px auto; /* Increased margin to create more space from the navbar */
    max-width: 800px; /* Limit the width for better readability */
    text-align: left;
    padding: 20px;
    /* background: rgba(255, 255, 255, 0.916); */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(14, 13, 13, 0.1);
}

.main-body-text h2 {
    color: #f3eded;
    font-size: 24px;
    font-weight: 600;
    line-height: 1.5;
}

.main-body-image {
    margin: 0px auto;
    text-align: center;
}

.main-body-image img {
    width: 80%; /* Adjust width as needed */
    max-width: 600px; /* Set a max-width to ensure the image doesn't get too large */
    height: auto;
    display: block;
    margin: 0 auto; /* Center the image horizontally */
}

.quiz-button {
    background-color: white;
    color: #3052f5;
    border: none;
    border-radius: 30px;
    padding: 15px 25px;
    font-size: 20px;
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 1000;
    transition: background-color 0.3s, transform 0.3s;
    text-decoration: none;
    text-align: center;
}

.quiz-button:hover {
    background-color: #f0f0f0;
    transform: scale(1.05);
}

.paragraph-text {
    padding: 20px;
    font-size: 18px;
    color: #f3efef;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.chat-button {
    background-color: white;
    color: #3052f5;
    border: none;
    border-radius: 30px;
    padding: 15px 25px;
    font-size: 20px;
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    transition: background-color 0.3s, transform 0.3s;
    text-decoration: none;
    text-align: center;
}

.chat-button:hover {
    background-color: #f0f0f0;
    transform: scale(1.05);
}

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('/LOGin/public/About/study.jpg');
            background-size: cover;
            background-position: center;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .header {
            color: #1a3c60;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 18px;
        }

        .form-section {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
            margin-bottom: 40px;
        }

        .form-section h2 {
            color: #1a3c60;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .submit-btn {
            background-color: #1a73e8;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #155bb5;
        }

        .students-section {
            margin-top: 40px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .students-section h3 {
            color: #1a3c60;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
        
    </style>
</head>
<body>

<div class="container">
    <!-- Form Section -->
    <nav class="navbar">
            <h1 class="logo-text">MindMentor</h1>
            <div class="nav-links">
                <a href="/mind-mentor/public/index.php">Home</a>
                

            </div>
        </nav>
    <div class="form-section">
        <h1>CONFUSED about which career to choose?</h1>
        <p>We'll help you find the one that's just right for you!</p>
        <p><em>We take you from career confusion to career clarity</em></p>

        <!-- Display success/error message after submission -->
        <?php if (isset($message)) { echo "<p style='color: green;'>$message</p>"; } ?>

        
    </div>

    <!-- Display All Students Section -->
    <div class="students-section">
        <h3>Submitted Students' Data</h3>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Education Level</th>
                    <th>Board</th>
                    <th>Stream</th>
                    <th>Percentage</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Interests</th>
                    <th>Career Goal</th>
                    <th>Parent's Name</th>
                    <th>Parent's Contact</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['education_level']; ?></td>
                        <td><?php echo $row['board']; ?></td>
                        <td><?php echo $row['stream']; ?></td>
                        <td><?php echo $row['percentage']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $row['state']; ?></td>
                        <td><?php echo $row['country']; ?></td>
                        <td><?php echo $row['interests']; ?></td>
                        <td><?php echo $row['career_goal']; ?></td>
                        <td><?php echo $row['parent_name']; ?></td>
                        <td><?php echo $row['parent_contact']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>