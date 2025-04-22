<?php
$con = new mysqli("localhost", "root", "", "userinfo");
if ($con->connect_error) die("Connection failed: " . $con->connect_error);

$message = "";
$success = false;

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if (isset($_POST['updatePhone']) && !empty($_POST['phone'])) {
        $phone = $_POST['phone'];
        $stmt = $con->prepare("UPDATE basicinfo SET phone_number = ? WHERE email = ?");
        $stmt->bind_param("ss", $phone, $email);
        $success = $stmt->execute();
        $message = $success ? "📞 Phone number updated successfully!" : "❌ Failed to update phone.";
    } 
    elseif (isset($_POST['updateEmail']) && !empty($_POST['new_email'])) {
        $new_email = $_POST['new_email'];
        $stmt = $con->prepare("UPDATE basicinfo SET email = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_email, $email);
        $success = $stmt->execute();
        $message = $success ? "📧 Email updated successfully!" : "❌ Failed to update email.";
    } 
    elseif (isset($_POST['updatePassword']) && !empty($_POST['new_password'])) {
        $new_password = $_POST['new_password'];
        $stmt = $con->prepare("UPDATE basicinfo SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_password, $email);
        $success = $stmt->execute();
        $message = $success ? "🔐 Password updated successfully!" : "❌ Failed to update password.";
    } else {
        $message = "⚠️ Missing new data to update.";
    }
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Status</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('https://images.unsplash.com/photo-1542281286-9e0a16bb7366?auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }

    .card {
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(10px);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
      max-width: 500px;
      text-align: center;
      animation: fadeIn 1s ease;
    }

    .card h2 {
      font-size: 28px;
      margin-bottom: 20px;
    }

    .card p {
      font-size: 18px;
      margin-bottom: 30px;
    }

    .btn {
      text-decoration: none;
      background-color: #28a745;
      padding: 12px 24px;
      color: white;
      border-radius: 8px;
      font-weight: bold;
      font-size: 16px;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background-color: #218838;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="card">
    <h2><?php echo $success ? "✅ Update Successful!" : "❌ Update Failed"; ?></h2>
    <p><?php echo $message; ?></p>
    <a class="btn" href="bibs.php">🎽 Go to Bib Generation</a>
  </div>
</body>
</html>
