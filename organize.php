<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) { 
    $statement = $mysqli->prepare("INSERT INTO event (start_time ,duration ,description ,pid)
VALUES (? ,? ,? , ?);
    ") or die($mysqli->error);
    $statement->bind_param("ssss", $_POST['startTime'] , $_POST['duration'], $_POST['description'],  $_SESSION['pid']);
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
        $statement->execute() or die($mysqli->error);
        echo "Event: " . $_POST['startTime'] . ", " . $_POST['duration'] . ", " . $_POST['description'] . ", " . $_SESSION['pid'] . " inserted.";
        $doneId = $mysqli->insert_id;
        foreach ($_POST['date'] as $datetime)
        {
            if ($datetime)
            {
                $statement = $mysqli->prepare("INSERT INTO eventdate (eid, edate) VALUES (? ,?)") or die($mysqli->error);
                $statement->bind_param("ss", $doneId , $datetime);
                $statement->execute() or die($mysqli->error);
            }
        }
        $statement = $mysqli->prepare("INSERT INTO invited (pid ,eid ,response ,visibility) VALUES (? ,? ,? ,?);
        ") or die($mysqli->error);
        $statement->bind_param("ssii", $_SESSION['pid'], $doneId, $a = 1, $a = 1);
        $statement->execute() or die($mysqli->error);
    }
    ?>
</body>
</html>