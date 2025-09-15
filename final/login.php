<?php
session_start();
require 'db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = trim($_POST['id']);
    $password = $_POST['password'];

    if ($id == '' || $password == '') {
        $error = "Both fields are required.";
    } else {
        $conn = getConnection();

        $sql = "SELECT l.password, r.user_type FROM login l JOIN reg r ON l.id = r.id WHERE l.id = '$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            $user_type = $row['user_type'];

            if (password_verify($password, $hashed_password)) {
                $_SESSION['id'] = $id;
                $_SESSION['user_type'] = $user_type;

                if ($user_type === 'Admin') {
                    header("Location: admin.php");
                    exit();
                } else {
                    header("Location: user.php");
                    exit();
                }
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "User ID not found. Please register first.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Login</title>
<style>
  body { font-family: Arial, sans-serif; margin: 20px; }
  form { border: 1px solid #ccc; padding: 20px; max-width: 350px; }
  h2 { margin: 0 0 15px 0; font-size: 18px; font-weight: bold; }
  label { display: block; margin-bottom: 5px; font-weight: bold; }
  input[type="text"], input[type="password"] { width: 98%; padding: 6px; margin-bottom: 15px; font-size: 14px; }
  button { padding: 8px 12px; font-weight: bold; font-size: 14px; }
  a { margin-left: 10px; font-size: 14px; text-decoration: none; color: #00f; }
  .error { color: red; margin-bottom: 10px; }
</style>
</head>
<body>
<form method="POST" action="">
  <h2>LOGIN</h2>

  <?php if ($error) echo "<div class='error'>$error</div>"; ?>

  <label for="id">User Id</label>
  <input type="text" id="id" name="id" value="<?= htmlspecialchars($id ?? '') ?>" required />

  <label for="password">Password</label>
  <input type="password" id="password" name="password" required />

  <button type="submit">Login</button>
  <a href="registration.php">Register</a>
</form>
</body>
</html>
