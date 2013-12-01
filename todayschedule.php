<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) { 
    $statement = $mysqli->prepare("SELECT DISTINCT event.eid, start_time, duration, description
    FROM event
    NATURAL JOIN eventdate
    FULL JOIN invited WHERE event.eid = invited.eid AND edate = ? AND invited.pid = ? AND invited.response = 1;
    ") or die($mysqli->error);
    $statement->bind_param("ss", date("Y-m-d") , $_SESSION['pid']);
    $statement->execute();
    $result = $statement->bind_result($eid, $start, $duration, $description);
    echo "<div class='title'>Today's Events</div>";
    while($statement->fetch())
    {
        echo "<div class='entry'>";
        echo "<div class='left'><span class='bold'>$eid - $description</span><br />Duration: $duration</div>";
        echo "<div class='right'>Starts: $start</div>";
        // echo $eid . ' ' . $start . ' ' . $end . ' ' . $duration . ' ' . $description . '<br />';
        echo "<div class='clear'></div></div>";
    }
} else {
        echo 'Please Login';
    }
?>