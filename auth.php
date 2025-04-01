<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($action == "register") {
        $email = $_POST['email'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Registration Successful!'); window.location.href='home.html';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "'); window.location.href='home.html';</script>";
        }
    } else if ($action == "login") {
        // Prepare and execute query to check if the user exists
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User found, now check password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Set session variable on successful login
                $_SESSION['username'] = $username;

                // Redirect to index.html after successful login
                header("Location: index.html");
                exit();
            } else {
                // Invalid password
                echo "<script>alert('Invalid Password!'); window.location.href='home.html';</script>";
            }
        } else {
            // User not found
            echo "<script>alert('User not found!'); window.location.href='home.html';</script>";
        }
    }
}
?>
