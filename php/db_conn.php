<?php
//Connect to MySQL database
$servername='localhost';
$username='root';
$password1='';
$dbname = "kit202_assignment";
$conn=mysqli_connect($servername,$username,$password1,$dbname);
if(!$conn){
   die('Could not Connect My Sql:' .mysqli_error($conn));
}
?> 