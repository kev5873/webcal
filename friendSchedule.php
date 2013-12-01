<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) { 
    $friend = explode(';',$_POST['friend']);
    $statement = $mysqli->prepare("SELECT event.eid, event.start_time, event.duration, event.description, invited.visibility FROM event, invited
    NATURAL JOIN eventdate
    WHERE event.eid = invited.eid AND edate = ? AND invited.pid = ?;
    ") or die($mysqli->error);
    $statement->bind_param("ss", $_POST['date'] , $friend[0]);
    $statement->execute();
    $result = $statement->bind_result($eid, $start, $duration, $description, $visibility);
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
        echo "What is happening with this friend on this day: ";
        echo $_POST['date'] . '<br />';
        while($statement->fetch())
        {
            if($visibility < $friend[1]){
                echo "<div class='entry'>";
                echo "<div class='left'><span class='bold'>$eid - $description</span><br />Duration: $duration</div>";
                echo "<div class='right'> ".$_POST['date'].", Start Time: $start</div>";
                echo "<div class='clear'></div></div><br />";
            }
            else if($visibility >= $friend[1])
                echo "This person is busy today.";
        }
    } else {
        echo 'Please Login';
    }
    ?>
    <br /><a href='index.php'>Back to Account</a>
</body>
</html>