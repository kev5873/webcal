<?
include("dbconfig.php");
?>
<div style="width:50%; float:left">
<?php include("todayschedule.php"); ?>
<?php include("myevents.php"); ?>
<?php include("invitations.php"); ?>
</div>
<div style="width:50%; float:right">
    <div class="title"> Check Schedule </div>
    <form method="post" action="acceptedschedule.php">
        <input type="text" name="date1" placeholder="date1" />
        <input type="text" name="date2" placeholder="date2" />
        <button type="submit">Check Schedule Between Dates</button>
    </form>
    <div class="title"> Organize Event </div>
    <form method="post" action="organize.php">
        <input type="text" name="startTime" placeholder="startTime" />
        <input type="text" name="duration" placeholder="duration" />
        <input type="text" name="description" placeholder="description" />
        <br />
        <input type="text" name="date[0]" placeholder="date1" />
        <input type="text" name="date[1]" placeholder="date2" />
        <input type="text" name="date[2]" placeholder="date3" />
        <br />
        <button type="submit">Organize new event</button>
    </form>
    <div class="title"> View Friend's Schedule </div>
    <?
    if(isset($_SESSION['pid'])) { 
        $statement = $mysqli->prepare("SELECT sharer, level FROM friend_of WHERE viewer = ?") or die($mysqli->error);
        $statement->bind_param("s", $_SESSION['pid']);
        $statement->execute();
        $result = $statement->bind_result($sharer, $level);
    }
    echo '<form method="post" action="friendSchedule.php">
            <input type="text" name="date" placeholder="date" />
            <select name="friend">';
            while($statement->fetch())
            {
                echo '<option value="'.$sharer.';'.$level.'">' . $sharer . '</option><br />';
            }
            echo "</select>
                <button type='submit'>View Friend's Schedule</button>
                </form>
            ";
    ?>
    <br />
</div>

