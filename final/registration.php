
<?php
require 'db.php';

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = trim($_POST['id']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $name = trim($_POST['name']);
    $user_type = $_POST['user_type'];

    if ($id == '') $errors[] = "ID is required.";
    if ($password == '') $errors[] = "Password is required.";
    if ($password !== $confirm_password) $errors[] = "Passwords do not match.";
    if ($name == '') $errors[] = "Name is required.";
    if ($user_type != 'User' && $user_type != 'Admin') $errors[] = "Invalid user type.";

    if (count($errors) === 0) {
        $conn = getConnection();

        $sqlCheckReg = "SELECT id FROM reg WHERE id = '$id'";
        $resultReg = mysqli_query($conn, $sqlCheckReg);

        $sqlCheckLogin = "SELECT id FROM login WHERE id = '$id'";
        $resultLogin = mysqli_query($conn, $sqlCheckLogin);

        if (mysqli_num_rows($resultReg) > 0 || mysqli_num_rows($resultLogin) > 0) {
            $errors[] = "User ID already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sqlReg = "INSERT INTO reg (id, name, user_type) VALUES ('$id', '$name', '$user_type')";
            $sqlLogin = "INSERT INTO login (id, password) VALUES ('$id', '$hashed_password')";

            $resReg = mysqli_query($conn, $sqlReg);
            $resLogin = mysqli_query($conn, $sqlLogin);

            if ($resReg && $resLogin) {
                $success = "Registration successful. You can now login.";
            } else {
                $errors[] = "Error in registration.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Registration</title>
<style>
  body { font-family: Arial, sans-serif; margin: 20px; }
  form { border: 1px solid #ccc; padding: 20px; max-width: 350px; }
  h2 { margin: 0 0 15px 0; font-size: 18px; font-weight: bold; }
  label { display: block; margin-bottom: 5px; font-weight: bold; }
  input[type="text"], input[type="password"] {
    width: 98%; padding: 6px; margin-bottom: 15px; font-size: 14px;
  }
  .user-type { margin-bottom: 15px; }
  .user-type label { font-weight: normal; margin-right: 10px; }
  button { padding: 8px 12px; font-weight: bold; font-size: 14px; }
  a { margin-left: 10px; font-size: 14px; text-decoration: none; color: #00f; }
  .error { color: red; margin-bottom: 10px; }
  .success { color: green; margin-bottom: 10px; }
</style>
</head>
<body>
<form method="POST" action="">
  <h2>REGISTRATION</h2>

  <?php
  foreach ($errors as $e) {
      echo "<div class='error'>$e</div>";
  }
  if ($success) {
      echo "<div class='success'>$success</div>";
  }
  ?>

  <label for="id">Id</label>
  <input type="text" id="id" name="id" value="<?= htmlspecialchars($id ?? '') ?>" required />

  <label for="password">Password</label>
  <input type="password" id="password" name="password" required />

  <label for="confirm_password">Confirm Password</label>
  <input type="password" id="confirm_password" name="confirm_password" required />

  <label for="name">Name</label>
  <input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required />

  <div class="user-type">
    <label>User Type</label>
    <label><input type="radio" name="user_type" value="User" <?= (isset($user_type) && $user_type === 'User') ? 'checked' : (!isset($user_type) ? 'checked' : '') ?> /> User</label>
    <label><input type="radio" name="user_type" value="Admin" <?= (isset($user_type) && $user_type === 'Admin') ? 'checked' : '' ?> /> Admin</label>
  </div>

  <button type="submit">Sign Up</button>
  <a href="login.php">Sign In</a>
</form>
</body>
</html>
```

