<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN FORM</title>

    <?php
    echo '<link rel="stylesheet" type="text/css" href="main.css">';
    ?>

</head>
<body>
<div class="container">
    <div class="grid-container">
        <img src="your logo.png" class="logo">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <h1> LOGIN FORM </h1>
            <label for="user">Username: </label><br>
            <input type="text" name="name" id="name" required/><br><br>

            <label for="user">Password: </label><br>
            <input type="password" name="password" id="password" required/><br><br>

            <input type="submit" name="submit" id="submit"/>
            <h3><a href="index.php">REGISTER</a><h3>
            <h3><a href="forget.php">FORGOT PASSWORD?</a><h3>
            <h3><a href="admin_login.php">ADMIN</a><h3>
        </form>
    </div>
</div>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $conn = mysqli_connect('localhost', 'root', 'Labyu_123', 'test1') or 
    die("Connection Failed: " . mysqli_connect_error());
    if(isset($_POST['name']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
    }

    $sql = "SELECT * FROM users WHERE name='$name' AND password='$password'";
    $query = mysqli_query($conn, $sql);

    session_start();

    if(mysqli_num_rows($query) == 1) {
        $row = mysqli_fetch_assoc($query);
        $name = $row['name'];
        $grade1 = $row['grade1'];
        $grade2 = $row['grade2'];
        $grade3 = $row['grade3'];
        $fullname = $row['fullname'];
        
        $_SESSION['name'] = $name;
        $_SESSION['grade1'] = $grade1;
        $_SESSION['grade2'] = $grade2;
        $_SESSION['grade3'] = $grade3;
        $_SESSION['fullname'] = $fullname;

        header('Location: welcome.php');
        exit();
    } else {
        echo 'Invalid Username or Password';
    }
}
?>