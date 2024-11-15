<?php
session_start();

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get the user's email from the session
$user_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Inline CSS for the dashboard layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .logout-btn {
            float: right;
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .card-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .card {
            background-color: #f9f9f9;
            padding: 20px;
            width: 45%;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h2 {
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .card p {
            margin-bottom: 15px;
            color: #555;
            font-size: 0.9em;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
    <button onclick="window.location.href='logout.php'" class="logout-btn">Logout</button>
        <h1>Welcome to the System: <?php echo htmlspecialchars($user_email); ?></h1>

        <div class="card-container">
            <div class="card">
                <h2>Add a Subject</h2>
                <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
                <button onclick="window.location.href='add_subject.php'" class="btn">Add Subject</button>
            </div>
            <div class="card">
                <h2>Register a Student</h2>
                <p>This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>
                <button onclick="window.location.href='student/register.php'" class="btn">Register</button>
                
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS, Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
