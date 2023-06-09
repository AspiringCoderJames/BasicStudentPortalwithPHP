<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATION FORM</title>

    <?php
    echo '<link rel="stylesheet" type="text/css" href="main.css">';
    ?>

</head>
<body>
    <div class="container">
        <div class="grid-container">
        <img src="your logo.png" class="logo">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <h1> RESET YOUR PASSWORD </h1>

                <label>OTP code:</label>
                <input type="text" name="code" id="code" required>
                <br><br>
                <label>New password:</label>
                <input type="password" name="password" id="password" required><br><br>
                <input type="submit" name="submit" id="submit"/><br><br>
                <h3><a href="login.php">LOGIN</a></h3>
            </form>
        </div>
    </div>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $conn = mysqli_connect('localhost', 'root', 'Labyu_123', 'test1') or 
    die("Connection Failed: " . mysqli_connect_error());
    
    if(isset($_POST['password']) && isset($_POST['code'])) {
        $password = $_POST['password'];
        $code = $_POST['code'];
    }

    $sql = "SELECT * FROM users WHERE code='$code'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $code = rand(100000, 999999);
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['name'];
        $sql = "UPDATE users SET password = '$password', code = '$code' WHERE name = '$user_id'";
        mysqli_query($conn, $sql);
        header('Location: passwordreset.php');
    }
    else {
        echo "Invalid OTP";
    }
}
?>