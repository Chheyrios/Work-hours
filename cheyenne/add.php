<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

$dbhost = "localhost";
$dbuser = "bit_academy";
$dbpass = "bit_academy";
$dbname = "cheyenne";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['admin_username'];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $start_time = $_POST["start_time"];
    $finish_time = $_POST["finish_time"];

    $stmt = $conn->prepare("INSERT INTO appointments (username, description, date, start_time, finish_time) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $description, $date, $start_time, $finish_time);
    $stmt->execute();

    header("Location: home.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="apple-touch-icon" sizes="180x180" href="img/favicon_io/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="img/favicon_io/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="img/favicon_io/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<?php include 'nav.php'; ?>
		<form action="add.php" method="post" class="custom-form">
			<label for="description">Description:</label>
			<textarea name="description" rows="4"></textarea>

			<label for="date">Date:</label>
			<input type="date" name="date" required>

			<label for="start_time">Start Time:</label>
			<input type="time" name="start_time" required>

			<label for="finish_time">End Time:</label>
			<input type="time" name="finish_time" required>

			<input type="submit" value="Submit">
		</form>
	</body>
</html>
