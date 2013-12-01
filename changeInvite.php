<?php
session_start();
include("dbconfig.php");
if(isset($_SESSION['pid'])) {
    $eid = $_POST['eid'];
    $statement = $mysqli->prepare("UPDATE invited SET response = ?, visibility = ? WHERE eid = ? AND pid = ?") or die($mysqli->error);
    $statement->bind_param("iiis", $_POST['response'], $_POST['visibility'], $_POST['eid'], $_SESSION['pid']);
    $statement->execute() or die($mysqli->error);
    echo "Changed Invite";
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
        // echo "Users invited";
	} else {
		echo 'Please Login';
    }
    ?>
</body>
</html>