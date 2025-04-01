<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: home.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-light">
  <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="card bg-secondary text-center p-4 rounded-3 shadow">
      <h1 class="display-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
      <p class="lead">We're glad to have you back at Uni Life.</p>
      <a href="logout.php" class="btn btn-primary mt-3">Logout</a>
    </div>
  </div>
</body>
</html>
