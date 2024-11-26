<!DOCTYPE html>
<html>
<head>
    <title>Retrieve Transcript</title>
    <style type="text/css">
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>My School System</h1>
    <p><b>Connect to the Database.</b></p>
    <p><i>
        <?php
        $servername = "localhost";
        $username = "root"; // Mysql username
        $password = "1234"; // Mysql Password
        $dbname = "student_grades"; // Database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . "<br>");
        }
        echo "DB Connected successfully.";
        ?>
    </i></p>

    <p><b>Retrieve Transcript for a Student.</b></p>
    <form method="post" action="./retrieve.php">
        <label for="studentid">Student ID:</label>
        <input type="text" id="studentid" name="studentid" required>
        <input type="submit" value="Retrieve Transcript">
    </form>

    <p><b>Display Transcript Records in a Table Format.</b></p>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentid = $_POST['studentid'];

        // Fetch student details
        $sqlStudent = "SELECT firstname, lastname, dob FROM STUDENTS WHERE studentid = '$studentid'";
        $resultStudent = $conn->query($sqlStudent);

        if ($resultStudent->num_rows > 0) {
            $student = $resultStudent->fetch_assoc();
            echo "<h2>Transcript for " . $student['firstname'] . " " . $student['lastname'] . " (DOB: " . $student['dob'] . ")</h2>";
        } else {
            echo "<p style='color:red;'>Student not found.</p>";
            $conn->close();
            exit();
        }

        // Fetch transcript details
        $sqlGrades = "SELECT C.coursename, C.credits, G.term, G.grade 
                      FROM GRADES G
                      INNER JOIN COURSES C ON G.courseid = C.courseid
                      WHERE G.studentid = '$studentid'";
        $resultGrades = $conn->query($sqlGrades);

        if ($resultGrades->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Course Name</th>
                        <th>Credits</th>
                        <th>Term</th>
                        <th>Grade</th>
                    </tr>";
            while ($row = $resultGrades->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['coursename'] . "</td>
                        <td>" . $row['credits'] . "</td>
                        <td>" . $row['term'] . "</td>
                        <td>" . $row['grade'] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color:red;'>No grades found for this student.</p>";
        }
    }
    ?>

    <p><b>Close the DB connection.</b></p>
    <p><i>
        <?php
        $conn->close();
        echo "Transcript Retrieved. <br>...DB Disconnect. Done.";
        ?>
    </i></p>
</body>
</html>

