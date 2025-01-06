<?php
// Include the database connection file
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $fathers_name = htmlspecialchars($_POST['fathers_name']);
    $enrollment_no = htmlspecialchars($_POST['enrollment_no']);
    $aadhaar_no = htmlspecialchars($_POST['aadhaar_no']);

    // Prepare and execute the SQL query
    $query = "INSERT INTO user (name, fathers_name, enrollment_no, aadhaar_no) VALUES ('$name', '$fathers_name', '$enrollment_no', '$aadhaar_no')";
    if (mysqli_query($link, $query)) {
        echo "Exam started for: " . htmlspecialchars($name);
        // Optionally, redirect to another page
        header("Location: quiz.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }

    // Close the database connection
    mysqli_close($link);
}
?>