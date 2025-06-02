<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password

    // Cek apakah username atau email sudah ada
    $checkQuery = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "<div class='message'>Username atau email sudah terdaftar!</div>";
    } else {
        // Insert data ke database
        $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($insertQuery)) {
            echo "<script>
                alert('Registrasi berhasil! Silakan login.');
                window.location.href = 'login.html';
            </script>";
        } else {
            echo "<div class='message error'>Error: " . $conn->error . "</div>";
        }
    }
}
?>