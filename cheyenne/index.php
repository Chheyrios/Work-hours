<?php
session_start();

$dbhost = "localhost";
$dbuser = "bit_academy";
$dbpass = "bit_academy";
$dbname = "cheyenne";

try {
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $dbh->prepare("SELECT id, username, password_hash FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            session_start();

            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];

            header("Location: home.php");
            exit();
        } else {
            $login_error = "Wrong username or password";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }
}

if (isset($_POST['register_submit'])) {
    $new_username = $_POST['register_username'];
    $new_password = $_POST['register_password'];

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    try {
        $stmt = $dbh->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
        $stmt->execute([$new_username, $hashed_password]);

        session_start();

        $_SESSION['admin_id'] = $dbh->lastInsertId(); 
        $_SESSION['admin_username'] = $new_username;

        header("Location: home.php");
        exit();
    } catch (PDOException $e) {
        $register_error = "Registration failed: " . $e->getMessage();
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
	</head>
<body>
    <div class="login-card">
        <h2 class="login-title">Login</h2>
        <form method="POST" action="index.php">
            <div class="login-form">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" autocomplete="off" required>
            </div>
            <div class="login-form">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" autocomplete="off" required>
            </div>
            <?php if (isset($login_error)) : ?>
                <p><?php echo $login_error; ?></p>
            <?php endif; ?>
            <button type="submit" class="login-button" name="submit">Login</button>
            <button type="button" class="register-button" name="register" onclick="window.location.href='register.php'">Register</button>
        </form>
    </div>
</body>
</html>

