<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) { 
    $statement = $mysqli->prepare("SELECT event.eid, start_time, TIME(start_time + 
    (SELECT duration FROM event
    NATURAL JOIN eventdate
    FULL JOIN invited WHERE event.eid = invited.eid AND edate = ? AND invited.pid = ? AND invited.response = 1)) AS end_time, duration, description
    FROM event
    NATURAL JOIN eventdate
    FULL JOIN invited WHERE event.eid = invited.eid AND edate = ? AND invited.pid = ? AND invited.response = 1;
    ") or die($mysqli->error);
    $statement->bind_param("ssss", date("Y-m-d") , $_SESSION['pid'] , date("Y-m-d") , $_SESSION['pid']);
    $statement->execute();
    $result = $statement->bind_result($eid, $start, $end, $duration, $description);
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
        echo "Your events for today are: ";
        echo date("Y-m-d") . '<br />';
                while($statement->fetch())
        {
            echo $eid . ' ' . $start . ' ' . $end . ' ' . $duration . ' ' . $description . '<br />';
        }
        } else {
                echo 'Please Login';
    }
    ?>
</body>
</html>