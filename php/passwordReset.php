<?php
	include('db_conn.php');

	$position = $_POST['position'];
	$id = $_POST['ID'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];

	if(($position != "null") AND ($id != "") AND ($question != "null") AND ($answer != "")){
		
		$IDCheck = preg_match('/^([0-9])+$/', $id);
		$answerCheck = preg_match('/^([A-Za-z0-9\s-,])+$/', $answer);

		$encryptedPassword = password_hash('Default1!', PASSWORD_BCRYPT);

		if (!$IDCheck || strlen($id) != 6){
			echo 'Student ID is invalid, check for non-numeric characters and ID length (ID should be 6 digits)';
		} else if(!$answerCheck){ 
			echo 'Please write an valid answer. Answer can contain spaces, hyphons, letters and numbers.';
		} else {
			//Student 
			if ($position == "student"){
				
				$questionFetch = $mysqli->query("SELECT * FROM a2_student_sec_question_answer WHERE student_ID = '".$id."'");
				$question_cnt = $questionFetch->num_rows;

				//Both a check for the question, and the user's role
				//All users have a sec question, so one will exist within the corresponding field
				if($question_cnt == 0){
					echo 'No question exists for this ID. Please ensure ID is correct, and that position is correct. If both are correct, contact IT support.';
				} else {
					
					//Check the selected question
						
					while($questionRow = mysqli_fetch_assoc($questionFetch)){
						$fetchedQuestion = $questionRow['question_ID'];
						$fetchedAnswer = $questionRow['answer'];
					}

					if($question != $fetchedQuestion){
						echo 'Selected question does not match your previously selected question.';
					//Success, now check if answers match
					} else if ($answer != $fetchedAnswer){
							echo 'Your entered answer does not match your previously entered answer.';
					//Success!
					} else {
						$passwordReset = "UPDATE a2_students SET password = '".$encryptedPassword."' WHERE student_ID = '".$id."'";
						if ($mysqli->query($passwordReset) === TRUE) {
							echo "Password reset. Your reset password is now: 'Default1!'. Please change this following password ASAP through the 'User Details' page.";
						} else {   
							//Outputs an error message for the query
							echo "Error: " . $mysqli->error;
						}
					}
				}
			//Staff
			} else if ($position == "staff"){
				
				$questionFetch = $mysqli->query("SELECT * FROM a2_staff_sec_question_answer WHERE staff_ID = ".$id."");
				$question_cnt = $questionFetch->num_rows;

				//Both a check for the question, and the user's role
				//All users have a sec question, so one will exist within the corresponding field
				if($question_cnt == 0){
					echo 'No question exists for this ID. Please ensure ID is correct, and that position is correct. If both are correct, contact IT support.';
				} else {
					
					//Check the selected question
						
					while($questionRow = mysqli_fetch_assoc($questionFetch)){
						$fetchedQuestion = $questionRow['question_ID'];
						$fetchedAnswer = $questionRow['answer'];
					}

					if($question != $fetchedQuestion){
						echo 'Selected question does not match your previously selected question.';
					//Success, now check if answers match
					} else if ($answer != $fetchedAnswer){
							echo 'Your entered answer does not match your previously entered answer.';
					//Success!
					} else {

						$passwordReset = "UPDATE a2_staff SET password = '".$encryptedPassword."' WHERE staff_ID = '".$id."'";
						if ($mysqli->query($passwordReset) === TRUE) {
							echo "Password reset. Your reset password is now: 'Default1!'. Please change this following password ASAP through the 'User Details' page.";
						} else {   
							//Outputs an error message for the query
							echo "Error: " . $mysqli->error;
						}
					}
				}
			}
		}
	} else if ($position == "null"){
		echo 'Please select your position.';
	} else if ($id == ""){
		echo 'Please enter your ID.';
	} else if ($question == "null"){
		echo 'Please select your question.';
	} else if ($answer == ""){
		echo 'Please enter your answer.';
	}
?>