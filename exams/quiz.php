<?php
// Check if the form data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['fathers_name']) && isset($_POST['enrollment_no']) && isset($_POST['aadhaar_no'])) {
    // Include user details from the previous form
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
} else {
    // Redirect back to start_exam.php if data is missing
    header("Location: start_exam.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .question {
            margin-bottom: 20px;
        }

        .question h3 {
            font-size: 18px;
        }

        .options label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .timer {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
    <script>
        // Set the countdown timer
        let timer = 30; // 1 hour in seconds
        function startTimer() {
            const timerElement = document.getElementById('timer');
            setInterval(() => {
                const hours = Math.floor(timer / 30);
                const minutes = Math.floor((timer % 30) / 60);
                const seconds = timer % 30;
                timerElement.innerHTML = `${hours}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                timer--;
                if (timer < 0) {
                    document.getElementById('quizForm').submit();
                }
            }, 1000);
        }

        window.onload = startTimer;
    </script>
</head>

<body>
    <div class="container">
        <div class="timer">Time Remaining: <span id="timer">00:00:30</span></div>
        <form id="quizForm" method="post" action="endexam.php">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="hidden" name="fathers_name" value="<?php echo htmlspecialchars($fathers_name); ?>">
            <input type="hidden" name="enrollment_no" value="<?php echo htmlspecialchars($enrollment_no); ?>">
            <input type="hidden" name="aadhaar_no" value="<?php echo htmlspecialchars($aadhaar_no); ?>">

            <?php foreach ($questions as $index => $question) : ?>
                <div class="question">
                    <h3><?php echo $index + 1 . '. ' . htmlspecialchars($question[0]); ?></h3>
                    <div class="options">
                        <?php for ($i = 1; $i <= 4; $i++) : ?>
                            <label>
                                <input type="radio" name="question<?php echo $index; ?>" value="<?php echo htmlspecialchars($question[$i]); ?>">
                                <?php echo htmlspecialchars($question[$i]); ?>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <input type="submit" class="btn" value="Submit">
        </form>
    </div>
</body>

</html>