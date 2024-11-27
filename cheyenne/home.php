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

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$totalHoursStmt = $conn->prepare("SELECT SUM(TIMESTAMPDIFF(HOUR, start_time, finish_time)) AS total_hours FROM appointments");
$totalHoursStmt->execute();
$totalHoursResult = $totalHoursStmt->fetch(PDO::FETCH_ASSOC);
$totalHours = $totalHoursResult['total_hours'];

if (isset($_POST['search_date'])) {
    $searchDate = $_POST['search_date'];
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE date = :search_date ORDER BY date DESC");
    $stmt->bindParam(':search_date', $searchDate);
} else {
    $countStmt = $conn->prepare("SELECT COUNT(*) AS total_records FROM appointments");
    $countStmt->execute();
    $totalRecordsResult = $countStmt->fetch(PDO::FETCH_ASSOC);
    $totalRecords = $totalRecordsResult['total_records'];

    $recordsPerPage = 15;

    $currentPage = isset($_GET['page']) ? max(1, min(ceil($totalRecords / $recordsPerPage), intval($_GET['page']))) : 1;

    $startIndex = ($currentPage - 1) * $recordsPerPage;

    $stmt = $conn->prepare("SELECT * FROM appointments ORDER BY date DESC LIMIT :start, :per_page");
    $stmt->bindParam(':start', $startIndex, PDO::PARAM_INT);
    $stmt->bindParam(':per_page', $recordsPerPage, PDO::PARAM_INT);
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
		<div class="total-hours-container">
			<div class="total-hours">
				<div class="total-hours-text">Total hours worked: <?= $totalHours ?> hours</div>
			</div>
		</div>
		<div class="search-form">
			<form method="post" action="">
				<label for="search_date">Search by Date:</label>
				<input type="date" id="search_date" name="search_date">
				<button type="submit">Search</button>
			</form>
		</div>
		<table>
		  <thead>
			<tr>
			  <th>Name</th>
			  <th>Description</th>
			  <th>Date</th>
			  <th>Start Time</th>
			  <th>End Time</th>
			</tr>
		  </thead>
		  <tbody>
			<?php foreach ($result as $row): ?>
				<tr>
				  <td><?= $row['username'] ?></td>
				  <td><?= $row['description'] ?></td>
				  <td><?= $row['date'] ?></td>
				  <td><?= $row['start_time'] ?></td>
				  <td><?= $row['finish_time'] ?></td>
				</tr>
			<?php endforeach; ?>
			   <?php
				if (isset($totalRecords)) {
					$totalPages = ceil($totalRecords / $recordsPerPage);
					echo "<div class='pagination'>";
					for ($i = 1; $i <= $totalPages; $i++) {
						echo "<a href='?page=$i'>$i</a> ";
					}
					echo "</div>";
				}
				?>
		  </tbody>
		</table>
	</body>
</html>