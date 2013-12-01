<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) {
    // Add security check
    $eid = $_POST['eid'];
    foreach ($_POST['users'] as $userPid)
    {
        $statement = $mysqli->prepare("INSERT INTO invited (pid, eid, response, visibility) VALUES (? ,?, ? ,?)") or die($mysqli->error);
        $statement->bind_param("ssii", $userPid , $eid, $a = 0, $a = 0);
        $statement->execute();
        if($mysqli->errno == 1062)
        {
            echo "$userPid is already invited <br />";
        }
        else
        {
            echo $mysql->error;
        }
    }
    echo "Invites sent";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>WebCal</title>
</head>
<body>
	<?php
	if(isset($_SESSION['pid'])) { 
        // echo "Users invited";
	} else {
		echo 'Please Login';
    }
    ?>
</body>
</html>