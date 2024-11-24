// Martin Genao 
// 11/23/24
// Post Grades Page

<!DOCTYPE html>
<html>
<head>
	<title>Post Grades</title>
	<style type="text/css">
		table, th, td {border: 1px solid black}
	</style>
</head>
<body>
	<h1>Post Grades</h1>
	<p><?php 
		$servername = "localhost";
		$username = "root"; // Mysql username
		$password = "1234"; // Mysql Password (Use your specific password)

		$dbname = "student_grades"; // database name
		 
		// Create connection
		// MySQLi is Object-Oriented method
		$conn = new mysqli($servername, $username, $password, $dbname);
		 
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error ."<br>");
		} 
		echo "<i>DB Connected successfully...</i>";
		?>
	</p>
	<p><b>Post Grades to the Database.</b></p>
	<form method="post" action="./post_grades.php">
	    <label for="studentid">Student ID:</label>
	    <input type="text" id="studentid" name="studentid" required><br><br>

	    <label for="courseid">Course ID:</label>
	    <input type="text" id="courseid" name="courseid" required><br><br>

	    <label for="term">Term:</label>
	    <input type="number" id="term" name="term" required><br><br>

	    <label for="grade">Grade:</label>
	    <input type="text" id="grade" name="grade" required><br><br>

	    <input type="submit" value="Submit">
	</form>

	<p><?php 
	    if ($_SERVER["REQUEST_METHOD"] == "POST") {
	        // Get input values
	        $studentid = $_POST['studentid'];
	        $courseid = $_POST['courseid'];
	        $term = $_POST['term'];
	        $grade = $_POST['grade'];

	        // Embedding SQL to perform interactions in the DB
	        $insertQuery = "INSERT INTO GRADES (courseid, studentid, term, grade) VALUES ('$courseid', '$studentid', '$term', '$grade')";
	        if ($conn->query($insertQuery) === TRUE) {
	            echo "<p style='color:green;'>Grade has been posted.</p>";
	        } else {
	            echo "<p style='color:red;'>Error -- Can't post grade: " . $conn->error . "</p>";
	        }
	    }
		?>
	</p>
	<p><b>Close the DB connection.</b></p>
	<p><?php 
		$conn->close();

		echo "<i>Process Completed. <br>...DB Disconnect. Done.</i>";
	?></p>
</body>
</html>