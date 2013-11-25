<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) { 
    $statement = $mysqli->prepare("
        SELECT eid, start_time, edate, duration, description FROM event NATURAL JOIN eventdate WHERE edate BETWEEN ? AND ? AND eid IN ( SELECT eid FROM event NATURAL JOIN invited WHERE invited.response = 1 )
    ") or die($mysqli->error);
    $statement->bind_param("ss", $_POST['date1'], $_POST['date2']);
    $statement->execute();
    $result = $statement->bind_result($eid, $start, $date, $duration, $description);
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
        echo "Your events between days ".$_POST['date1']. " and ". $_POST['date2']." are: ";
        echo date("Y-m-d") . '<br />';
		while($statement->fetch())
        {
            echo $eid . ' ' . $start . ' ' . $duration . ' ' . $date . ' ' . $description . '<br />';
        }
	} else {
		echo 'Please Login';
    }
    ?>
</body>
</html>