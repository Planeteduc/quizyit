<?php
if (isset($_POST['download'])) {
    include "../connection.php";
    $sql1 = "SELECT id, name, fathers_name, enrollment_no, aadhaar_no, score, total FROM quiz_results";
    $result = $link->query($sql1);

    // Define the filename with .xls extension
    $filename = "students_record.xls";

    // Set the HTTP headers to indicate the file download
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    // Start output buffering
    ob_start();

    // Output the table structure for Excel
    echo '<table border="1">';
    echo '<thead><tr><th>Enrollment No</th><th>Student Name</th><th>Father Name</th><th>Aadhaar No</th><th>Obtained Marks</th><th>Total Marks</th></tr></thead>';
    echo '<tbody>';
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["enrollment_no"] . '</td>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["fathers_name"] . '</td>';
            echo '<td>' . $row["aadhaar_no"] . '</td>';
            echo '<td>' . $row["score"] . '</td>';
            echo '<td>' . $row["total"] . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">0 results</td></tr>';
    }
    
    echo '</tbody>';
    echo '</table>';

    // Get the buffer contents and clean the buffer
    $content = ob_get_clean();

    // Output the contents to the browser
    echo $content;

    // Close the database connection
    $link->close();

    // Stop the script execution after sending the content
    exit();
}
?>
