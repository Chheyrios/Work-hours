<?php
$dbhost = "localhost";
$dbuser = "bit_academy";
$dbpass = "bit_academy";
$dbname = "cheyenne";

if (isset($_POST['register'])) {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    try {
        $dbh = new PDO( "mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass );
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $stmt = $dbh->prepare("SELECT id FROM users WHERE username = :new_username LIMIT 1");
        $stmt->bindParam(':new_username', $new_username);
        $stmt->execute();

        if ($stmt->fetch()) {
            $error = "Username already exists. Please choose another one.";
        } else {
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $dbh->prepare("INSERT INTO users (username, password_hash) VALUES (:new_username, :password_hash)");
            $stmt->bindParam(':new_username', $new_username);
            $stmt->bindParam(':password_hash', $password_hash);
            $stmt->execute();

            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
        exit();
    }
}
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
		<title>Register</title>
	</head>
<body>
<div class="register-card">
    <h2 class="register-title">Create an Account</h2>
    <form method="POST" action="register.php">
        <div class="register-form">
            <label for="new_username">Username:</label>
            <input type="text" id="new_username" name="new_username" autocomplete="off" required>
        </div>
        <div class="register-form">
            <label for="new_password">Password:</label>
            <input type="password" id="new_password" name="new_password" autocomplete="off" required>
        </div>
        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <button type="submit" class="register-button" name="register">Register</button>
    </form>
</div>
</body>
</html>
