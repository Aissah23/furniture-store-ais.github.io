<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cari pengguna di database
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Simpan data pengguna ke localStorage (untuk frontend)
            echo "<script>
                localStorage.setItem('loggedInUser', JSON.stringify({ username: '$username', email: '${user['email']}' }));
                window.location.href = 'index.html';
            </script>";
        } else {
            echo "<div class='message error'>Password salah!</div>";
        }
    } else {
        echo "<div class='message error'>Username tidak ditemukan!</div>";
    }
}
?>