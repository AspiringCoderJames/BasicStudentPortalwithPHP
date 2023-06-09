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
    $fullname = $row['fullname'];
    $_SESSION['grade1'] = $grade1;
    $_SESSION['grade2'] = $grade2;
    $_SESSION['grade3'] = $grade3;
    $_SESSION['fullname'] = $fullname;
} else {
    $grade1 = 'Error';
    $grade2 = 'Error';
    $grade3 = 'Error';
    $fullname = 'Error';
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

    <style>
    .logout {
        transform: translateY(-700%);
        height: 6%;
        width: 6%;
    }

    .grade-container {
        transform: translateY(-50%);
    }
    
    .container {
        height: 100vh;
        background-image: url("Place\ your\ BG\ here.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
    
    </head>

    <body>
    <div class="container">
        <div class="grid-container">
            <form action="" method="POST">
                <img src="your logo.png" class="logo">
                <h2 class="bsu">Welcome to <br><span style="color: red">James University,</span><br> <?php echo $fullname; ?></h2>

                <div class="opt">
                    <label for="user">How may I help you?</label><br><br>   
                    <select name="mySelect" id="mySelect">
                        <option value="curriculum">Curriculum</option>
                        <option value="grades">Grades</option>
                        <option value="liabilities">Liabilities</option>
                        <option value="schedules">Schedules</option>
                        <option value="scholarships">Scholarships</option>
                        <option value="subjects">Subjects</option>
                        <option value="health">Health Declaration Form</option>
                    </select>
                    <input type="submit" name="submit" id="submit"/>
                </div>
                <a href="login.php"><img src="logout.png" class="logout"></a>

                <div class="grade-container">
                    <?php
                    if(isset($_POST['submit'])) {
                        if($_POST['mySelect'] === 'grades') {
                            echo '<p class="grade">Grade 1: ' . $grade1 . '</p>';
                            echo '<p class="grade">Grade 2: ' . $grade2 . '</p>';
                            echo '<p class="grade">Grade 3: ' . $grade3 . '</p>';
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
