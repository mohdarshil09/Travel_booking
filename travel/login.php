<?php
include 'config.php';
session_start();

error_reporting(0); // Turn off error reporting to avoid warnings being shown

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to check if the user exists with the provided email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If a user is found with that email
    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();

        // Verify the password using password_verify()
        if (password_verify($password, $row['password'])) {
            // Start the session and store the username in session
            $_SESSION['username'] = $row['username'];
            // Redirect to home.php after successful login
            header("Location: home.php");
            exit(); // Ensure no further code runs after redirect
        } else {
            echo "<script>alert('Oops! Incorrect password.')</script>";
        }
    } else {
        echo "<script>alert('Oops! No account found with that email.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo isset($password) ? $password : ''; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
        </form>
    </div>
</body>
</html>
