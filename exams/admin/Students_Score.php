<!DOCTYPE html>
<html lang="en">

<head>
    <title>Students' Scores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 90%;
            margin-left: 10%;
            border-radius: 8px;
            border: 1px solid #ddd;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            margin-left: 30%;
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .scrollable {
            max-height: 400px;
            overflow-y: auto;
        }
        .change{
            background-color:rgb(185, 150, 98);
            color:black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .change:hover {
            background-color:rgb(201, 123, 6);
            color:black;
        }
    </style>
</head>

<body>
    <h1>Students' Scores</h1>
    <p>Students results show here</p>
    <table id="scoreTable">
        <tr>
            <th>Enrollment No</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>Aadhaar No</th>
            <th>Obtained Marks</th>
            <th>Total Marks</th>
        </tr>
        <?php
        include "../connection.php";
        $sql1 = "SELECT id, name, fathers_name, enrollment_no, aadhaar_no, score, total FROM quiz_results";
        $result = $link->query($sql1);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["enrollment_no"] . "</td><td>" . $row["name"] . "</td><td>" . $row["fathers_name"] . "</td><td>" . $row["aadhaar_no"] . "</td><td>" . $row["score"] . "</td><td>" . $row["total"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='6'>0 results</td></tr>";
        }
        $link->close();
        ?>
    </table>
    <form method="post" action="score.php">
        <button type="submit" class="change" name="download">Download Excel</button>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var table = document.getElementById("scoreTable");
            var rowCount = table.rows.length;
            if (rowCount > 11) {
                table.parentElement.classList.add("scrollable");
            }
        });
    </script>
</body>

</html>