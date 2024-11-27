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
    if ($_POST["action"] == "delete") {
        $id = $_POST["id"];
        $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } elseif ($_POST["action"] == "edit") {
        header("Location: edit.php?id=" . $_POST["id"]);
        exit();
    }

    header("Location: home.php");
    exit();
}

$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);

$appointments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
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
		<div class="social-bar">
		  <div class="social-icons"> 
			  <a href="#"><img src="img/instagram-icon.png" alt="Facebook"></a> 
			  <a href="#"><img src="img/email-icon.png" alt="Twitter"></a> 
			  <a href="#"><img src="img/whatsapp-icon.png" alt="Instagram"></a> 
			</div>
		</div>
		<div class="nav"> 
			<a href="home.php" class="logo-left"><img src="img/blackcherry.png" alt="Logo-black" class="logo-left"></a>
		  <div class="nav-links"><br>
			<a href="home.php">Home</a> 
			<a href="add.php">Add</a> 
			<a href="details.php">Details</a> 
			<a href="logout.php">Logout</a> 
		  </div>
		</div>
    <?php if (!empty($appointments)): ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Action</th>
            </tr>
            <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?php echo $appointment['username']; ?></td>
                    <td><?php echo $appointment['description']; ?></td>
                    <td><?php echo $appointment['date']; ?></td>
                    <td><?php echo $appointment['start_time']; ?></td>
                    <td><?php echo $appointment['finish_time']; ?></td>
                    <td>
						<div class="btn-container">
                        <form action="details.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="submit" value="X">
                        </form>
                        <form action="details.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>">
                            <input type="hidden" name="action" value="edit">
                            <input type="submit" value="Edit">
                        </form>
						</div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
</body>
</html>
