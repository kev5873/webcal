<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) { 
    $statement = $mysqli->prepare("
        SELECT pid, fname, lname FROM person
        ") or die($mysqli->error);
    $statement->execute();
    $result = $statement->bind_result($pid, $fname, $lname);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>WebCal</title>
</head>
<body>
    <form method="post" action="issueInvitationDo.php">
    <input type="hidden" name="eid" value="<?= $_GET['eid']; ?>">
	<?php
	if(isset($_SESSION['pid'])) { 
        echo "Select the users you want to invite: <br />";

		while($statement->fetch())
        {
            echo $pid . ' ' . $fname . ' ' . $lname . '<input type="checkbox" name="users[]" value="' . $pid . '"><br />';
        }
        echo "<input type='submit'>";
	} else {
		echo 'Please Login';
    }
    ?>
    </form>
</body>
</html>