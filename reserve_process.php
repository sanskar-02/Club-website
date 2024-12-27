<?php
// Include the database connection
include_once 'admin/includes/dbconnection.php';

// Set response header to JSON
// header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input
    $clubName = mysqli_real_escape_string($con, $_POST['clubName']);
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $time = mysqli_real_escape_string($con, $_POST['time']);
    $person = intval($_POST['person']);

    // Validate input fields
    if (empty($clubName) || empty($fullName) || empty($email) || empty($date) || empty($time) || $person <= 0) {
        echo json_encode(['success' => false, 'error' => 'Invalid input data']);
        exit;
    }

    // Insert reservation with pending status
    $query = "INSERT INTO club_bookings (ClubName, FullName, Email, Date, Time, PerCount, Payment_Status, Pay_Id, Token_id) 
              VALUES ('$clubName', '$fullName', '$email', '$date', '$time', $person, 'pending', NULL, NULL)";
    
    if (mysqli_query($con, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
