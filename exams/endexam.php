<?php
// Include the database connection file
include 'connection.php';

// Get user details from the previous form
$name = htmlspecialchars($_POST['name']);
$fathers_name = htmlspecialchars($_POST['fathers_name']);
$enrollment_no = htmlspecialchars($_POST['enrollment_no']);
$aadhaar_no = htmlspecialchars($_POST['aadhaar_no']);

$csvFile = 'uploads/Book1.csv';
if (!file_exists($csvFile)) {
    die('File not found.');
}
$questions = array_map('str_getcsv', file($csvFile));
if ($questions === false) {
    die('Error reading the file.');
}
array_shift($questions); // remove the first row if it's the header

$score = 0;
$total = count($questions);

foreach ($questions as $index => $question) {
    $userAnswer = isset($_POST['question' . $index]) ? $_POST['question' . $index] : '';
    $correctAnswer = isset($question[5]) ? trim($question[5]) : ''; // Trimming spaces to avoid mismatch
    if ($userAnswer === $correctAnswer) {
        $score++;
    }
}

// Store the quiz results in the database
$stmt = mysqli_prepare($link, "INSERT INTO quiz_results (name, fathers_name, enrollment_no, aadhaar_no, score, total) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssssii", $name, $fathers_name, $enrollment_no, $aadhaar_no, $score, $total);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <style>
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
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* .score {
            font-size: 24px;
            margin-bottom: 20px;
        } */

        /* .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: inline-block;
        }

        .btn:hover {
            background-color: #45a049;
        } */

        h1 {
            color: #333;
            font-size: 24px;
        }

        p {
            color: #666;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (mysqli_stmt_execute($stmt)): ?>
            <h1>Thank you for submitting Exam.</h1>
            <p>Results will be out in 15 to 20 days!<br>Best of luck!</p>
        <?php else: ?>
            <h1>Error: <?php echo mysqli_stmt_error($stmt); ?></h1>
        <?php endif; ?>
    </div>
    <?php
    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    ?>
</body>

</html>