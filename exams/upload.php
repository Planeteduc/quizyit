<?php
$isFileUploaded = false;
$uploadMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csvfile'])) {
    $target_dir = "uploads";
    $target_file = $target_dir . basename($_FILES['csvfile']['name']);
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    if (move_uploaded_file($_FILES['csvfile']['tmp_name'], $target_file)) {
        $uploadMessage = "The file " . basename($_FILES['csvfile']['name']) . " has been uploaded.";
        $isFileUploaded = true;
    } else {
        $uploadMessage = "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV</title>
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
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: auto;
        }
        .hidden {
            display: none;
        }
        .visible {
            display: block;
        }
        .message {
            margin: 15px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
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
        .btn[disabled] {
            background-color: #cccccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <label for="csvfile">Choose CSV file:</label>
            <input type="file" name="csvfile" id="csvfile" onchange="document.getElementById('submitBtn').disabled = false;">
            <input type="submit" id="submitBtn" class="btn" value="Upload CSV" disabled>
        </form>

        <p class="message"><?php echo $uploadMessage; ?></p>
        <button id="nextBtn" class="btn hidden" onclick="redirectToQuiz()">Next</button>

        <?php if ($isFileUploaded): ?>
            <script>
                document.getElementById('nextBtn').classList.remove('hidden');
                document.getElementById('nextBtn').classList.add('visible');
            </script>
        <?php endif; ?>
    </div>

    <script>
        function redirectToQuiz() {
            window.location.href = 'quiz.php';
        }
    </script>
</body>
</html>
