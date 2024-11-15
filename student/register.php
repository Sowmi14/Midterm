<?php
session_start();

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Initialize session-based storage for students if not already set
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = []; // Initialize an empty array for students
}

$students = $_SESSION['students']; // Retrieve students array from session
$success_message = "";
$error_message = "";

// Handle form submission for adding a new student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Check if the student already exists
    $exists = false;
    foreach ($students as $student) {
        if ($student['student_id'] === $student_id) {
            $exists = true;
            break;
        }
    }

    if ($exists) {
        $error_message = "Student with this ID already exists.";
    } else {
        // Add the new student to the session
        $students[] = ['student_id' => $student_id, 'first_name' => $first_name, 'last_name' => $last_name];
        $_SESSION['students'] = $students; // Save back to session

        $success_message = "Student registered successfully!";
    }
}

// Handle form submission for editing a student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Find and update the student
    foreach ($students as &$student) {
        if ($student['student_id'] === $student_id) {
            $student['first_name'] = $first_name;
            $student['last_name'] = $last_name;
            $_SESSION['students'] = $students; // Save back to session
            $success_message = "Student updated successfully!";
            break;
        }
    }
}

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Find and remove the student
    foreach ($students as $key => $student) {
        if ($student['student_id'] === $delete_id) {
            unset($students[$key]);
            $_SESSION['students'] = array_values($students); // Reindex array
            $success_message = "Student deleted successfully!";
            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5">

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/Midtermx/dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Student</li>
    </ol>
</nav>


    <h2>Register a New Student</h2>

    <!-- Success or Error Message -->
    <?php if ($success_message): ?>
        <div class="alert alert-success">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <!-- Registration Form -->
    <form method="post" action="">
        <input type="hidden" name="action" value="add">
        <div class="mb-3">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="student_id" name="student_id" required>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
        
    </form>

    <!-- Student List Table -->
    <h3 class="mt-5">Student List</h3>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                    <td>
                        <a href="edit_student.php?student_id=<?php echo $student['student_id']; ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="?delete_id=<?php echo $student['student_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
