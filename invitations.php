<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) { 
    $statement = $mysqli->prepare("
        SELECT eid, response, visibility FROM invited WHERE pid = ?
        ") or die($mysqli->error);
    $statement->bind_param("s", $_SESSION['pid'] );
    $statement->execute();
    $result = $statement->bind_result($eid, $response, $visibility);
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
        echo "Here are all your invitations: <br />";
		while($statement->fetch())
        {
            echo 'Event: ' . $eid . ' Visibility Level: ' . $visibility . ' <br />';
            if($response == 0) {
                echo 'Not Responded';
            } else if($response == 1) {
                echo 'Accepted';
            } else {
                echo 'Declined';
            }
            echo '<form method="post" action="changeInvite.php">
            <input type="hidden" name="eid" value="'.$eid.'">
            Your Response
            <select name="response">
                <option value="1">Accept</option>
                <option value="2">Decline</option>
            </select>
            Level
            <select name="visibility">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <input type="submit">
            </form><br />';
        }
	} else {
		echo 'Please Login';
    }
    ?>
</body>
</html>