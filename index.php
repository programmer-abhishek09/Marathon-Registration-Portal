<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <!-- Google Fonts & Animate.css for animation -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('https://images.unsplash.com/photo-1508780709619-79562169bc64?auto=format&fit=crop&w=1950&q=80') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .success-box {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 30px 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            animation: fadeInDown 1s ease;
        }

        .success-box h2 {
            color: #00ffcc;
            font-size: 26px;
            margin-bottom: 15px;
        }

        .success-box p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .success-box a {
            text-decoration: none;
            background-color: #00cc99;
            padding: 12px 24px;
            color: white;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .success-box a:hover {
            background-color: #00997a;
        }
    </style>
</head>
<body>

<?php
if (isset($_POST['name'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "userinfo";

    // Create connection
    $con = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Collect form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $check_stmt = $con->prepare("SELECT * FROM basicinfo WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "<div class='success-box animate__animated animate__shakeX'>
                <h2>⚠️ Already Registered!</h2>
                <p>This email is already registered. Please login instead.</p>
                <a href='login.html'>Go to Login</a>
              </div>";
    } else {
        // Insert new user
        $stmt = $con->prepare("INSERT INTO basicinfo (name, age, phone_number, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $name, $age, $phone, $email, $password);

        if ($stmt->execute()) {
            echo "<div class='success-box animate__animated animate__fadeInUp'>
                    <h2>🎉 Registration Successful!</h2>
                    <p>Welcome to the marathon, <strong>" . htmlspecialchars($name) . "</strong>!</p>
                    <a href='login.html'>🚀 Click here to login</a>
                  </div>";
        } else {
            echo "<div class='success-box animate__animated animate__shakeX'>
                    <h2>❌ Error!</h2>
                    <p>Something went wrong: " . $stmt->error . "</p>
                  </div>";
        }

        $stmt->close();
    }

    $check_stmt->close();
    $con->close();
}
?>

</body>
</html>
