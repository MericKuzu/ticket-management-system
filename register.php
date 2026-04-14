<?php
include 'db.php';

$error = '';
$success = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {

        $checkSql = "SELECT id FROM users WHERE email = ?";
        $checkStmt = $conn->prepare($checkSql);

        if (!$checkStmt){
            $error = "Database error: " . $conn->error;
        } else {
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                $error = "Email is already registered.";
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $insertSql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                $insertStmt = $conn->prepare($insertSql);

                if (!$insertStmt) {
                    $error = "Prepare error: " . $conn->error;
                } else {
                    $insertStmt->bind_param("sss", $full_name, $email, $passwordHash);
                    if ($insertStmt->execute()) {
                        header("Location: login.php");
                        exit;
                    } else {
                        $error = "Registration failed: " . $insertStmt->error;
                    }
                    $insertStmt->close();
                }
            }
            $checkStmt->close();
        }
    }
}

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <center><h1>Register</h1></center>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="register.php" method="post" class="ticket-form">
            
        <div class="form-group full">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>  
        
        <div class="form-group full">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group half">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group half">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        
        <div class="form-group full">
            <button type="submit">Register</button>
        </div>

        </form>

        <p style="text-align: center; margin-top: 20px;">
            Already have an account? 
            <a href="login.php">Login</a>
        </p>
    </div>
</body>
</html>