<!--
Sign-Out for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244), 
-->

<?php
include("session.php");
//destroy the sessions saved before.
session_destroy();
//automatically go back to signin form
header('Location: ../Sign-In.php');
?>