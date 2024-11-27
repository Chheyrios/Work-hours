<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    if ($_POST["action"] == "update") {
        $id = $_POST["id"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $start_time = $_POST["start_time"];
        $finish_time = $_POST["finish_time"];

        $stmt = $conn->prepare("UPDATE appointments SET description=?, date=?, start_time=?, finish_time=? WHERE id=?");
        $stmt->bind_param("ssssi", $description, $date, $start_time, $finish_time, $id);
        $stmt->execute();
    }

    header("Location: home.php");
    exit();
}

$id = $_GET["id"];
$stmt = $conn->prepare("SELECT * FROM appointments WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $appointment = $result->fetch_assoc();
} else {
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
		<form action="edit.php" method="post" class="custom-form">
			<input type="hidden" name="id" value="<?php echo $appointment['id']; ?>">
			<label for="username">Username:</label>
			<input type="text" name="username" value="<?php echo $appointment['username']; ?>" readonly>
			<label for="description">Description:</label>
			<input type="text" name="description" value="<?php echo $appointment['description']; ?>">
			<label for="date">Date:</label>
			<input type="text" name="date" value="<?php echo $appointment['date']; ?>">
			<label for="start_time">Start Time:</label>
			<input type="text" name="start_time" value="<?php echo $appointment['start_time']; ?>">
			<label for="finish_time">Finish Time:</label>
			<input type="text" name="finish_time" value="<?php echo $appointment['finish_time']; ?>">
			<input type="hidden" name="action" value="update">
			<input type="submit" value="Update">
		</form>
	</body>
</html>
