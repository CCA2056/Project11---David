<?php
//starting session
session_start();

//if the session ID has not been set, initialise it
if(!isset($_SESSION['session_ID'])){
	$_SESSION['session_ID']="0";
}
//if the session first name has not been set, initialise it
if(!isset($_SESSION['session_firstname'])){
	$_SESSION['session_firstname']="";
}
//if the session access level has not been set, initialise it
if(!isset($_SESSION['session_access'])){
	$_SESSION['session_access']="0";
}

//save username in the session 
$session_ID=$_SESSION['session_ID'];

//save username in the session 
$session_firstname=$_SESSION['session_firstname'];

//save access level in the session 
$session_access=$_SESSION['session_access'];
?>