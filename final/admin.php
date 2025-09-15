<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$adminUser = htmlspecialchars($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Home</title>
<style>
  body { font-family: Arial, sans-serif; }
  .container {
    border: 1px solid #ccc;
    width: 250px;
    padding: 20px;
    margin: 20px auto;
    text-align: center;
  }
  h1 { font-weight: bold; }
  a {
    display: block;
    margin: 5px 0;
    color: purple;
    text-decoration: underline;
    cursor: pointer;
  }
</style>
</head>
<body>
  <div class="container">
    <h1>Welcome <?= $adminUser ?>!</h1>
    <a href="#">Profile</a>
    <a href="#">Change Password</a>
    <a href="#">View Users</a>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>
