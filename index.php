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
            <h1> REGISTRATION FORM </h1>
            <label for="user">Username: </label><br>
            <input type="text" name="name" id="name" required/><br><br>

            <label for="user">Full Name: </label><br>
            <input type="text" name="fullname" id="fullname" required/><br><br>

            <label for="user">Password: </label><br>
            <input type="text" name="password" id="password" required/><br><br>

            <label for="user">Email: </label><br>
            <input type="text" name="email" id="email" required/><br><br>

            <input type="submit" name="submit" id="submit"/> <br><br>
            <h3><a href="login.php">LOGIN</a></h3>
        </form>
    </div>
</div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $conn = mysqli_connect('localhost', 'root', 'Labyu_123', 'test1') or 
    die("Connection Failed: " . mysqli_connect_error());

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `name` = '$name'");
    if (mysqli_num_rows($query) > 0) {
        echo 'Warning: A similar account already exists.';
    } else {
        $sql = "INSERT INTO `users` (`name`, `fullname`, `password`, `email`) VALUES ('$name', '$fullname', '$password', '$email')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            header('Location: entrysuccessful.php');
        } else {
            echo 'Error Occurred: ' . mysqli_error($conn);
        }
    }
}
?>