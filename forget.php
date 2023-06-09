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
                <h1> FORGOT PASSWORD </h1>

                <label for="user">Email: </label><br>
                <input type="type" name="email" id="email" required/><br><br>

                <input type="submit" name="submit" id="submit"/><br>
                
                <h3><a href="login.php">LOGIN</a></h3>
            </form>
        </div>
    </div>
</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Invalid email address';
    } else {
        $code = rand(100000, 999999);
        $expiry_time = time() + (60 * 30);
        $conn = mysqli_connect('localhost', 'root', 'Labyu_123', 'test1') or die("Connection Failed: " . mysqli_connect_error());

        $sql = "SELECT name FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['name'];

            $sql = "UPDATE users SET code = '$code', expiry_time = '$expiry_time' WHERE name = '$user_id'";
            if (mysqli_query($conn, $sql)) {
                require 'phpmailer/vendor/autoload.php';
                $mail = new PHPMailer(True);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'pogisijamesmagnaye@gmail.com';
                $mail->Password = 'jumpxeqruaiaptnk';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('pogisijamesmagnaye@gmail.com', 'James');
                $mail->addAddress($email);

                $mail->Body = "Hello,\n\nYou have requested to reset your password. Your OTP code is $code. Please use this code to reset your password.\n\nThank you,\nThe Team";

                if ($mail->send()) {
                    header('Location: reset_password.php?email=' . urlencode($email));
                    exit;
                } else {
                    $error_message = 'Failed to send email';
                }
            } else {
                $error_message = 'Failed to update OTP code';
            }
        } else {
            $error_message = 'User not found';
        }

        mysqli_close($conn);
    }
}
?>