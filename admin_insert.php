<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATION FORM</title>

    <?php
    echo '<link rel="stylesheet" type="text/css" href="main.css">';
    ?>

    <style>
    .logout {
        transform: translateY(65%);
        height: 6%;
        width: 6%;
    }
    </style>

</head>
<body>
    <div class="container">
        <div class="grid-container">
        <img src="your logo.png" class="logo">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <h1> ENTER GRADES </h1>
            <label for="user">Student Name: </label><br>
            <input type="text" name="name" id="name"/><br><br>

            <label for="user">Grade 1: </label><br>
            <input type="text" name="grade1" id="grade1"/><br><br>

            <label for="user">Grade 2: </label><br>
            <input type="text" name="grade2" id="grade2"/><br><br>

            <label for="user">Grade 2: </label><br>
            <input type="text" name="grade3" id="grade4"/><br><br>

            <input type="submit" name="submit" id="submit"/>
            <br><br>
            
            <a href="login.php"><img src="logout.png" class="logout"></a>
        </form>
        </div>
    </div>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $conn = mysqli_connect('localhost', 'root', 'Labyu_123', 'test1') or 
    die("Connection Failed: " . mysqli_connect_error());
    
    if(isset($_POST['name']) && isset($_POST['grade1']) && isset($_POST['grade2']) && isset($_POST['grade3'])) {
        $name = $_POST['name'];
        $grade1 = $_POST['grade1'];
        $grade2 = $_POST['grade2'];
        $grade3 = $_POST['grade3'];
    }

    $sql = "SELECT * FROM users WHERE name='$name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['name'];
        $sql = "UPDATE users SET grade1 = '$grade1', grade2 = '$grade2', grade3 = '$grade3' WHERE name = '$user_id'";
        mysqli_query($conn, $sql);
        echo "Successful";
    }
    else {
        echo "";
    }
}
?>