<?php
session_start();

// Check if the student ID is set in the URL
if (isset($_GET['studentID']) && isset($_SESSION['students'][$_GET['studentID']])) {
    $studentID = $_GET['studentID'];
    $student = $_SESSION['students'][$studentID];

    // Handle form submission to delete student data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        unset($_SESSION['students'][$studentID]);
        header("Location: register.php");
        exit();
    }
} else {
    echo "Student not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h3 class="mb-5">Delete a Student</h3>
        <nav aria-label="breadcrumb">
        
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="/Midterm/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="register.php">Register Student</a></li>
                <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
            </ol>
        </nav>

        <!-- Delete Confirmation -->
        <div class="card p-4 mt-3">
            <p>Are you sure you want to delete the following student record?</p>
            <ul>
                <li><strong>Student ID:</strong> <?= htmlspecialchars($student['studentID']); ?></li>
                <li><strong>First Name:</strong> <?= htmlspecialchars($student['firstName']); ?></li>
                <li><strong>Last Name:</strong> <?= htmlspecialchars($student['lastName']); ?></li>
            </ul>
            <form method="POST">
                <!-- Adjust gap between buttons -->
                <div class="d-flex gap-3">
                    <a href="register.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Delete Student Record</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>