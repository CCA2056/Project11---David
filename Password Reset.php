<!DOCTYPE html>

<?php
    //include the file session.php
    include('php/session.php');
	include('php/db_conn.php');


    //if there is any received error message
    if(isset($_GET['error']))
    {
	    $errormessage=$_GET['error'];
	    //show error message using javascript alert
	    echo "
		<script>alert('$errormessage');</script>";
    }

	if($session_access != 0){
		header('location: ./Home.php?error=Access%20Denied');
	}

?>

<html lang="en">
	<head>	
		<title>University of DoWell: Course Management System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style-master.css">
		<link rel="stylesheet" href="css/style-table.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>

		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<style>
			/**/
		</style>
	</head>
	<body>
		<!-- The Navigation Bar -->
		<!-- Note: For this page, it's highly simplified due to it's overall purpose -->
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
			<a class="navbar-brand">University of DoWell</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="Home.php">Home</a>
					</li>
				</ul>
			</div>
		</nav>

		<!-- Main Content -->
		<!-- Note: For this page, it's highly simplified due to it's overall purpose -->
		<div class="container" style="margin-top:15px; margin-bottom: 45px;">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="text-center">Password Reset</h2>
					<br>
				</div>
				<div class="col-sm-12">
					<p>Please enter your ID, and proceed to answer your chosen security question from your registration.</p>

					<form id="pwdReset" action="" method="POST">
						<label for="positionSelect">Select your position:</label>
						<select class="form-control" id="positionSelect">
							<option value="null">-select an option-</option>
							<option value="student">Student</option>
							<option value="staff">Staff Member</option>
						</select>
						<br><br>
						<label for="ID">Your ID: </label>
						<br>
						<input class="form-control" type="text" id="ID" name="ID" placeholder="e.g 321672">
						<br><br>
						<label for="questionSelect">Your Question: </label>
						<p class="font-italic small">This is the question you chose at registration.</p>
						<select class="form-control" id="questionSelect">
							<?php
								//Query value
								$questionsQuery = "SELECT * FROM a2_sec_questions";

								//a php function using the value
								$questionsQueryResult = $mysqli->query($questionsQuery);
								echo '<option value="null">-select an option-</option>';
								while($questionsRow = mysqli_fetch_array($questionsQueryResult)){
									echo '
										<option value="'.$questionsRow['question_ID'].'">'.$questionsRow['question_ID'].' - '.$questionsRow['questiondesc'].'</option>
									';
								}
							?>
						</select>
						<br><br>
						<label for="answer">Answer: </label>
						<br>
						<input class="form-control" type="text" id="answer" name="answer">
						<br><hr>

						<button type="button" class="btn btn-success" id="resetPwdSubmit">Reset Your Password</button>
					</form>
				</div>
			</div>
		</div>

		<script>
            $(document).ready(function(){
                $("#resetPwdSubmit").click(function(){
					var position = $("#positionSelect option:selected").val();
					var ID = $("#ID").val();
					var question = $("#questionSelect option:selected").val();
                    var answer = $("#answer").val();
					alert("Pressed!");

                    $.ajax({
                        url: "php/passwordReset.php",
                        method: "POST",
                        data:{	//Data to be submitted
                            position,
							ID,
							question,
							answer,
                        },
                        dataType: "html",
                        //Reloads the page to update table
                        //If the message output is as shown, send to main page
                        success: function(data){
                            alert(data);
                            if(data.trim()=="Password reset. Your reset password is now: 'Default1!'. Please change this following password ASAP through the 'User Details' page."){
                                window.location.href='Home.php';
							} else {
                                location.preventDefault();   
							}
			            }
                    });
                });
            });
        </script>
	</body>
</html>
