<?php
    include("database.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2> Welcome to Facebook </h2>
        <p> Username: </p> 
        <input type="text" name="username"> <br> 
        <p> Password: </p> 
        <input type="password" name="password"> <br> <br>
        <input type="submit" name="submit" value="Register">
    </form>
</body>
</html>

<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($username) && empty($password)) {
            echo "Please enter both username and password.";
        } elseif (empty($username)) {
            echo "Please enter the username.";
        } elseif (empty($password)) {
            echo "Please enter the password.";
        } else {
            $sql_check = "SELECT * FROM users WHERE user = '$username'";
            $result = mysqli_query($conn, $sql_check);

            if (mysqli_num_rows($result) > 0) {
                echo "Username already exists. Please choose another one.";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (user, password) VALUES ('$username', '$hash')";

                if (mysqli_query($conn, $sql)) {
                    echo "Registration successfully done.";
                } else {
                    echo "Error: " . mysqli_error($conn);  
                }
            }
        }
    }

    if (isset($conn)) {
        mysqli_close($conn);
    }
?>
