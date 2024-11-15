<?php
session_start();

// Check if the student ID is set in the URL
if (isset($_GET['studentID']) && isset($_SESSION['students'][$_GET['studentID']])) {
    $studentID = $_GET['studentID'];
    $student = $_SESSION['students'][$studentID];

    // Handle form submission to update student data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updatedFirstName = $_POST['firstName'];
        $updatedLastName = $_POST['lastName'];

        // Update the student data in the session
        $_SESSION['students'][$studentID]['firstName'] = $updatedFirstName;
        $_SESSION['students'][$studentID]['lastName'] = $updatedLastName;

        // Redirect back to register.php after updating
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
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-5">Edit Student</h3>
        
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="/Midterm/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="register.php">Register Student</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
            </ol>
        </nav>

        <!-- Edit Form -->
        <form method="POST" class="card p-4 mt-4">
            <div class="mb-3">
                <label for="studentID" class="form-label">Student ID</label>
                <input type="text" class="form-control bg-light" id="studentID" name="studentID" value="<?= htmlspecialchars($student['studentID']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?= htmlspecialchars($student['firstName']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?= htmlspecialchars($student['lastName']); ?>" required>
            </div>
            
            <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-primary">Update Student</button>
</div>

        </form>
    </div>
</body>
</html>