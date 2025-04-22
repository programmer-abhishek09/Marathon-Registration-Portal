<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Bibs</title>
    <style>
        :root {
            --bg-light: #f4f4f9;
            --bg-dark: #121212;
            --text-light: #121212;
            --text-dark: #f4f4f9;
            --card-light: #ffffffcc;
            --card-dark: #1e1e1ecc;
            --accent: #00d4ff;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 40px 20px;
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: all 0.3s ease;
        }

        body.dark-mode {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .toggle {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .toggle button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .card {
            background: var(--card-light);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease;
        }

        body.dark-mode .card {
            background: var(--card-dark);
        }

        h2 {
            margin-bottom: 10px;
        }

        input[type="file"] {
            padding: 10px;
            border-radius: 6px;
            width: 100%;
            margin-top: 10px;
        }

        button {
            margin-top: 10px;
            background-color: #28a745;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #b52b37;
        }

        .bib-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .bib-card {
            background: var(--card-light);
            border-left: 6px solid var(--accent);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        body.dark-mode .bib-card {
            background: var(--card-dark);
        }

        .bib-card:hover {
            transform: translateY(-4px);
        }

        .bib-number {
            font-size: 20px;
            font-weight: bold;
            color: var(--accent);
        }

        .bib-info {
            font-size: 14px;
            margin-top: 10px;
        }

        .view-link {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
        }

        .view-link:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="toggle">
        <button onclick="toggleTheme()">🌓 Toggle Theme</button>
    </div>

    <div class="container">
        <div class="card">
            <div class="header">
                <h2>Welcome, <?php echo htmlspecialchars($email); ?> 👋</h2>
                <p>Upload your certificate to generate your marathon bib!</p>
            </div>

            <?php
            // Check if user already has a bib
            $con = new mysqli("localhost", "root", "", "userInfo");
            $stmt = $con->prepare("SELECT COUNT(*) FROM bibs WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($bibCount);
            $stmt->fetch();
            $stmt->close();

            if ($bibCount >= 1) {
                echo "<p>✅ You've already generated a bib. Scroll down to view it.</p>";
            } else {
                echo '<form action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="certificate" required>
                    <button type="submit">Upload & Generate Bib</button>
                </form>';
            }

            echo '<a href="exit.php" class="logout-btn">🚪 Logout</a>';
            ?>

            <div class="bib-grid">
                <?php
                $stmt = $con->prepare("SELECT bib_code, certificate_path, uploaded_at FROM bibs WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='bib-card'>
                        <div class='bib-number'>🎽 Bib: {$row['bib_code']}</div>
                        <div class='bib-info'>
                            <p>📅 Uploaded on: {$row['uploaded_at']}</p>
                            <a href='{$row['certificate_path']}' target='_blank' class='view-link'>📄 View Certificate</a>
                        </div>
                    </div>";
                }
                $stmt->close();
                $con->close();
                ?>
            </div>
        </div>
    </div>

    <script>
        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
</body>
</html>
