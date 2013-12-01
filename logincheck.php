<?php
session_start();
include("dbconfig.php");

$statement = $mysqli->prepare("SELECT * FROM person WHERE pid = ? AND passwd = md5(?)");
$statement->bind_param("ss", $_POST['user'], $_POST['pass']);
$statement->execute();
$result = $statement->bind_result($pid, $passwd, $fname, $lname, $priv);
if($statement->fetch())
{
	echo "Login success.";
	$_SESSION['pid'] = $pid;
	$_SESSION['fname'] = $fname;
	$_SESSION['priv'] = $priv;
}
else
{
	echo "Login Failed";
}
?>
<a href='index.php'>Go to Account</a>