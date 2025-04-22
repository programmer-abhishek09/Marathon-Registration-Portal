<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$email = $_SESSION['email'];
$uploadDir = "uploads/";

// Ensure upload directory exists
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["certificate"])) {
    $con = new mysqli("localhost", "root", "", "userInfo");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // 🔍 Check if user already has a bib
    $stmt = $con->prepare("SELECT COUNT(*) FROM bibs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($bibCount);
    $stmt->fetch();
    $stmt->close();

    if ($bibCount > 0) {
        echo "<script>alert('❌ You have already uploaded a certificate and received a bib.'); window.location.href='bibs.php';</script>";
        exit();
    }

    $file = $_FILES["certificate"];
    $fileName = basename($file["name"]);
    $fileTmp = $file["tmp_name"];
    $targetPath = $uploadDir . uniqid("cert_") . "_" . $fileName;

    if (move_uploaded_file($fileTmp, $targetPath)) {
        // ✅ Generate unique bib code
        $bibCode = strtoupper(uniqid("BIB"));

        // Insert into database
        $stmt = $con->prepare("INSERT INTO bibs (email, bib_code, certificate_path, uploaded_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $email, $bibCode, $targetPath);
        if ($stmt->execute()) {
            echo "<script>alert('✅ Certificate uploaded and bib generated!'); window.location.href='bibs.php';</script>";
        } else {
            echo "Database error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "❌ Failed to upload certificate.";
    }

    $con->close();
} else {
    echo "❌ Invalid request.";
}
?>
