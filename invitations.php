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
    echo "<div class='title'>Invitations</div>";
	while($statement->fetch())
    {
        echo "<div class='entry'>";
        echo "<div class='left'><span class='bold'>Event: $eid</span><br />Visibility Level: $visibility</div>";
        echo "<div class='right'>Response: ";
        if($response == 0) {
            echo 'Not Responded';
        } else if($response == 1) {
            echo 'Accepted';
        } else {
            echo 'Declined';
        }
        echo '<br />';
        echo '<form method="post" action="changeInvite.php">
        <input type="hidden" name="eid" value="'.$eid.'">
        Respond: 
        <select name="response">
            <option value="1">Accept</option>
            <option value="2">Decline</option>
        </select>
        Level
        <select name="visibility">
            <option value="'.$_SESSION['priv'].'">'.$_SESSION['priv'].'</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <input type="submit">
        </form></div>';
        echo '<div class="clear"></div></div>';
    }
    
} else {
	echo 'Please Login';
}
?>