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

$recordsPerPage = 15;

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

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $recordsPerPage;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_date"])) {
    $search_date = $_POST["search_date"];
    $sql = "SELECT * FROM appointments WHERE date = ? ORDER BY date DESC LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $search_date, $offset, $recordsPerPage);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM appointments ORDER BY date DESC LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $offset, $recordsPerPage);
    $stmt->execute();
    $result = $stmt->get_result();
}

$appointments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

$totalRecords = $conn->query("SELECT COUNT(*) AS total_records FROM appointments")->fetch_assoc()['total_records'];
$totalPages = ceil($totalRecords / $recordsPerPage);

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
    <div class="search-form">
        <form method="post" action="">
            <label for="search_date">Search by Date:</label>
            <input type="date" id="search_date" name="search_date">
            <button type="submit">Search</button>
        </form>
    </div>

    <?php if (!empty($appointments)) { ?>
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
                                <input type="submit" value="Delete">
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
			<div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
        </table>
    <?php } ?>
</body>
</html>