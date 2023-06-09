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
            <h1>PASSWORD HAS BEEN CHANGED SUCCESSFULLY</h1>
            <h3><a href="login.php">LOGIN</a></h3>
        </form>
    </div>
</div>
</body>
</html>