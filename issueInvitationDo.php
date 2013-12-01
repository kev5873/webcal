<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) {

    $eid = $_POST['eid'];
    // Security check.
    $statement2 = $mysqli->prepare("SELECT pid FROM event WHERE eid = ?") or die($mysqli->error);
    $statement2->bind_param("i", $eid);
    $statement2->execute();
    $result2 = $statement2->bind_result($pid);
    $statement2->fetch();
    $statement2->store_result();

    if ($pid == $_SESSION['pid'])
    {
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