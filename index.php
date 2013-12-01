<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>WebCal</title>
    <link rel="stylesheet" href="index.css" />
</head>
<body>
    <div id="container">
        <h2>WebCal</h2>
    	<?php
    	if(isset($_SESSION['pid'])) {
            echo "<div style='float:left'>Welcome " . $_SESSION['fname'] . "!<br />&nbsp;</div>";
            echo "<div style='float:right'>Today is ".date('Y-m-d')." | <a href='logout.php'>Logout</a> </div>";
            echo "<div style='clear:both'></div>";
    		include("nav.php");
    		
    	} else {
    		echo '
            Please login to begin.
        <form method="post" action="logincheck.php">
            <input type="text" name="user" placeholder="user" />
            <input type="text" name="pass" placeholder="pass" />
            <button type="submit">LOGIN</button>
        </form> ';
        }
        ?>
    </div>
</body>
</html>