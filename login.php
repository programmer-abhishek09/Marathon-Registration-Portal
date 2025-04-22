<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userinfo";

// Connect to DB
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$message = "";
$isSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $con->prepare("SELECT * FROM basicinfo WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            session_start();
            $_SESSION["email"] = $email;

            $message = "Login successful!";
            $isSuccess = true;
        } else {
            $message = "❌ Invalid email or password.";
        }

        $stmt->close();
    } else {
        $message = "❌ Please enter both email and password.";
    }
} else {
    $message = "❌ Please submit the form from the login page.";
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Result</title>
    <link rel="stylesheet" href="afterLoginStyle.css">
</head>
<body>
    <div class="result-container <?php echo $isSuccess ? 'success' : 'error'; ?>">
        <div class="card">
            <h2><?php echo $isSuccess ? '🎉 Login Successful!' : 'Login Failed 😕'; ?></h2>
            <p><?php echo $message; ?></p>

            <?php if ($isSuccess): ?>
                <a class="btn" href="bibs.php">📄 Go to Bibs Page</a><br><br>
                <a class="btn" href="update.html">✏️ Update Your Info</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
