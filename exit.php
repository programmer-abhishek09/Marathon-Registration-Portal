<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Goodbye!</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.65);
            padding: 50px 30px;
            border-radius: 15px;
            max-width: 600px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        a {
            display: inline-block;
            text-decoration: none;
            padding: 12px 24px;
            background-color: #ff4757;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #e84118;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>👋 Thanks for visiting!</h1>
        <p>Your session has ended. We hope to see you again soon.</p>
        <a href="login.html">🔁 Back to Login</a>
    </div>
</body>
</html>
