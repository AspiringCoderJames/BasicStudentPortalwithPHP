<?php
session_start();
if(isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
} else {
    $name = 'Error';
}
$conn = mysqli_connect('localhost', 'root', 'Labyu_123', 'test1') or 
die("Connection Failed: " . mysqli_connect_error());

$sql = "SELECT * FROM users WHERE name='$name'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
if($row) {
    $grade1 = $row['grade1'];
    $grade2 = $row['grade2'];
    $grade3 = $row['grade3'];
    $_SESSION['grade1'] = $grade1;
    $_SESSION['grade2'] = $grade2;
    $_SESSION['grade3'] = $grade3;
} else {
    $grade1 = 'Error';
    $grade2 = 'Error';
    $grade3 = 'Error';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATION FORM</title>
    
    <?php
    echo '<link rel="stylesheet" type="text/css" href="welcome.css">';
    ?>
    
    </head>
<body>
    <div class="container">
        <img src="your logo.png" class="logo">
        <h1 class="welcome-text">Welcome to MJSU, <?php echo $name; ?></h1>
        <div>
        <p class="grade">Grade 1: <?php echo $grade1; ?></p>
        <p class="grade">Grade 2: <?php echo $grade2; ?></p>
        <p class="grade">Grade 3: <?php echo $grade3; ?></p>
        </div>
    </div>
</body>
</html>