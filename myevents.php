<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) { 
    $statement = $mysqli->prepare("SELECT event.eid,eventdate.edate,event.start_time,event.duration,event.description,event.pid, count(invited.eid) AS number_attending        
    FROM event NATURAL JOIN eventdate
    LEFT JOIN invited
    ON (event.eid = invited.eid)
    WHERE event.pid = ? AND invited.response = 1
    GROUP BY event.eid
    ") or die($mysqli->error);
    $statement->bind_param("s", $_SESSION['pid'] );
    $statement->execute();
    $result = $statement->bind_result($eid, $date, $start, $duration, $description, $pid, $invited);
    echo "<div class='title'>My Events</div>";
	while($statement->fetch())
    {
        echo "<div class='entry'>";
        echo "<div class='left'><span class='bold'>$eid - $description</span><br />Duration: $duration <a href='issueInvitation.php?eid=$eid'>Invite</a></div>";
        echo "<div class='right'>Attending: $invited<br />$date, $start</div>";
        echo "<div class='clear'></div></div>";
    }
}
else {
	echo 'Please Login';
}
?>