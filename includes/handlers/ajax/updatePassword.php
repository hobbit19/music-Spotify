<?php 
include("../../config.php");
if(!isset($_POST['username'])){
	echo "ERROR: Could not set username";
	exit();
}
if(!isset($_POST['oldPassword'])||!isset($_POST['newPassword1'])||!isset($_POST['newPassword2'])){
	echo "Not all passwords be set!";
	exit();
}
if($_POST['oldPassword']==""||$_POST['newPassword1']==""||$_POST['newPassword2']==""){
	echo "Please fill in all fields!";
	exit();
}

$username = $_POST['username'];
$oldPassword = $_POST['oldPassword'];
$newPassword1 = $_POST['newPassword1'];
$newPassword2 = $_POST['newPassword2'];

$oldMd5 = md5($oldPassword);

$passwordCheck = mysqli_query($con,"SELECT * FROM users WHERE username = '$username' AND password = '$oldMd5'");
if (mysqli_num_rows($passwordCheck)!=1){
	echo "Password is incorrect";
	exit();
}

if ($newPassword1!=$newPassword2){
	echo "Your new password not match!";
	exit();
}
if (preg_match('/[^A-Za-z0-9]/',$newPassword1)){
	echo "Your password must contain only letters and nubmers!";
	exit();
}
if (strlen($newPassword1)>30||strlen($newPassword1)<5){
	echo "your password have to between 5 to 30 chars";
}

$newMd5 = md5($newPassword1);

$query = mysqli_query($con, "UPDATE users SET password='$newMd5' WHERE username='$username'");
echo "Update successful";





?>