<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>WebCal</title>
</head>
<body>
	<?php
	if(isset($_SESSION['pid'])) { 
		include("nav.php");
		echo "Welcome";
	} else {
		echo '
    <form method="post" action="logincheck.php">
        <input type="text" name="user" placeholder="user" />
        <input type="text" name="pass" placeholder="pass" />
        <button type="submit">LOGIN</button>
    </form> ';
    }
    ?>
</body>
</html>