<?php
session_start();
include 'db.php';  // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get user from database
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php"); // Redirect on success
            exit();
        } else {
            echo "<script>alert('Invalid Password!'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('User does not exist!'); window.location.href='login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
