<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) { 
    $statement = $mysqli->prepare(" SELECT event.eid,event.start_time,event.duration,event.description,event.pid, count(invited.eid) AS number_attending        
FROM event
LEFT JOIN invited
ON (event.eid = invited.eid)
WHERE event.pid = ?
GROUP BY event.eid
    ") or die($mysqli->error);
    $statement->bind_param("s", $_SESSION['pid'] );
    $statement->execute();
    $result = $statement->bind_result($eid, $start, $duration, $description, $pid, $invited);
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
        echo "Here are the events you've organized: <br />";
		while($statement->fetch())
        {
            echo $eid . ' ' . $start . ' ' . $duration . ' ' . $description . ' ' . $pid . ' ' . $invited . '<br />';
        }
	} else {
		echo 'Please Login';
    }
    ?>
</body>
</html>