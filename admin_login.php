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
                <h1> ADMIN LOGIN </h1>
                <label for="user">Username: </label><br>
                <input type="text" name="adminname" id="adminname" required/><br><br>

                <label for="user">Password: </label><br>
                <input type="password" name="adminpassword" id="adminpassword" required/><br><br>

                <input type="submit" name="submit" id="submit"/> <br><br>
                <h3><a href="login.php">LOGIN AS STUDENT</a></h3>
            </form>
        </div>
    </div>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $conn = mysqli_connect('localhost', 'root', 'Labyu_123', 'test1') or 
    die("Connection Failed: " . mysqli_connect_error());
    if(isset($_POST['adminname']) && isset($_POST['adminpassword'])) {
        $adminname = $_POST['adminname'];
        $adminpassword = $_POST['adminpassword'];
    }

    $sql = "SELECT * FROM admin WHERE adminname='$adminname' AND adminpassword='$adminpassword'";
    $query = mysqli_query($conn, $sql);

    session_start();

    if(mysqli_num_rows($query) == 1) {
        header('Location: admin_insert.php');
        $_SESSION['adminname'] = $adminname;
        exit();
    } else {
        echo 'Invalid Username or Password';
    }
}
?>