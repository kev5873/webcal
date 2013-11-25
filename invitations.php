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
        echo "Here are all your invitations: ";
		while($statement->fetch())
        {
            echo $eid . ' ' . $response . ' ' . $visibility . '<br />';
        }
	} else {
		echo 'Please Login';
    }
    ?>
</body>
</html>