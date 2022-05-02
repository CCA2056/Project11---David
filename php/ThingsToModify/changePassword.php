<?php
	//include the file session.php
	include("session.php");
	//include the file db_conn.php
	include("db_conn.php");

	//receive the data from the form
	$oldPassword		= $_POST['oldPassword'];
	$newPassword		= $_POST['newPassword'];
	$confirmNewPassword = $_POST['confirmNewPassword'];

	$userID = $session_ID;

	if (($oldPassword != "") AND ($newPassword != "") AND ($confirmNewPassword != "")){
		
		//Checks for the entered data
		$oldPasswordCheck = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!?@#$%^])([a-zA-Z0-9\-_!?@#$%^])+$/', $oldPassword);
		$newPasswordCheck = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!?@#$%^])([a-zA-Z0-9\-_!?@#$%^])+$/', $newPassword);
		
		//Validation successful, continue
		//queries to check whether ID is in the table (check whether the user is registered)
		$studentQuery = "SELECT * FROM `a2_students` WHERE student_ID ='$userID'";
		$staffQuery = "SELECT * FROM `a2_staff` WHERE staff_ID ='$userID'";

		//execute query to the database and retrieve the result
		$studentQueryResult = $mysqli->query($studentQuery);
		$staffQueryResult = $mysqli->query($staffQuery);

		//convert the results to array (the key of the array will be the column names of the table)
		$rowStudent=$studentQueryResult->fetch_array(MYSQLI_ASSOC);
		$rowStaff=$staffQueryResult->fetch_array(MYSQLI_ASSOC);

		//Checks to see which table the ID exists in
		if($rowStudent['student_ID'] == $userID){
			//Encrypted password check
			if(!$oldPasswordCheck){
				echo 'Password requires at least 1 Upper and lowercase letter, 1 number, and at least 1 of the following characters: !?@#$%^"';
			} else if(!$newPasswordCheck){ 
				echo 'Password requires at least 1 Upper and lowercase letter, 1 number, and at least 1 of the following characters: !?@#$%^"';
			} else if ($newPassword == $confirmNewPassword){
				
				if(password_verify($oldPassword, $rowStudent['password'])) {
					$encryptedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);

					$updatePassword = "UPDATE a2_students SET password = '".$encryptedNewPassword."' 
					WHERE student_ID ='".$userID."'";
					
					
					if($mysqli->query($updatePassword) === TRUE){
						echo 'Password Change Successful.';
					} else {
						echo "Error: " . $mysqli->error;
					}
				} else {
					echo 'Old password is incorrect.';
				}
			} else {
				echo 'Passwords do not match.';
			}
		//Doesn't exist in student table, check staff table
		} else if ($rowStaff['staff_ID'] == $userID){
			//Encrypted password check
			if(!$oldPasswordCheck){
				echo 'Password requires at least 1 Upper and lowercase letter, 1 number, and at least 1 of the following characters: !?@#$%^"';
			} else if(!$newPasswordCheck){ 
				echo 'Password requires at least 1 Upper and lowercase letter, 1 number, and at least 1 of the following characters: !?@#$%^"';
			} else if ($newPassword == $confirmNewPassword){
				if(password_verify($oldPassword, $rowStaff['password'])) {
					$encryptedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);

					$updatePassword = "UPDATE a2_staff SET password = '".$encryptedNewPassword."' 
					WHERE staff_ID ='".$userID."'";
					
					
					if($mysqli->query($updatePassword) === TRUE){
						echo 'Password Change Successful.';
					} else {
						echo "Error: " . $mysqli->error;
					}
				} else {
					echo 'Old password is incorrect.';
				}
			} else {
				echo 'Passwords do not match.';
			}
		} else {
			echo 'Error: ID not found. How are you here?';
		}
	} else if ($oldPassword == ""){
		echo 'Please enter your old password';
	} else if ($newPassword == ""){
		echo 'Please enter your new password.';
	} else if ($confirmNewPassword == ""){
		echo 'Please re-enter your new password.';
	} else {
		echo 'Please fill out all fields.';
	}
?>