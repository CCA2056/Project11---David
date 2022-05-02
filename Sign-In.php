<!--
Sign-in Page for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244), 
-->
<!DOCTYPE html>

<?php
    //include the file session.php
    include('php/session.php');

    //if there is any received error message
    if(isset($_GET['error']))
    {
	    $errormessage=$_GET['error'];
	    //show error message using javascript alert
	    echo "
		<script>alert('$errormessage');</script>";
    }
?>

<html lang="en">
    <head>	
        <title>Environmental Data Analysis Tool</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/sign-in.css">
		    
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>

		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <style>
	        /*Nothing needed here yet...*/
        </style>    
    </head>

    <body style="background-color:#182E53;"> 
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <form id="loginForm" action="" method="POST" class="form-signin" style="background-color:#ffffff;">
                        <h2 class="mb-3 fw-normal text-center">Environmental Data Analysis Tool</h2>
                        <p class="mb-3 fw-normal text-center"><i>Please sign in</i></p>
						<div class="col-sm" style="color:lightgray">
							<?php
								if ($session_access == "0") {
									echo '
									<div>
										<p>Not Logged in</p>
									</div>
									';
								}else if ($session_access != "0"){
									echo '
									<div>
										<p>Logged in</p>
									</div>
									';
								}
							?>
						</div>
                        <div class="form-floating" style="padding-bottom: 0.25px;">
                            <input type="email" class="form-control shadow-none" id="loginID" placeholder="name@example.com">
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control shadow-none" id="loginPassword" placeholder="Password">
                        </div>
						<div class="form-floating" style="padding-bottom:10px;">
							<a href="Password Reset.php" style="color:black;" >Forgot Password?</a>
                        </div>
                        <?php
							//If user is logged in, display log out and user details options
							if ($session_access != "0") {
								echo '
									<a href="php/signout.php" class="w-100 btn btn-lg btn-primary" role="button" id="logout">
									Logout <i class="fas fa-sign-in-alt"></i></a>
								';
							//Else, if user is not logged in, display log in button
							} else {
								echo '
									<button class="w-100 btn btn-lg btn-primary" type="submit" id="login">Sign in</button>
								';
							}
						?>
                    </form>
                </div>
            </div>
        </div>

		<!-- Ajax for login -->
        <script>
			$(document).ready(function () {
				$("#login").click(function () {
					var id = $("#loginID").val();
					var pwd = $("#loginPassword").val();

					$.ajax({
						url: "php/login_engine.php",
						method: "POST",
						data: {	//Data to be submitted
							id,
							pwd,
						},
						dataType: "html",
						//Reloads the page to update table
						//If the message output is as shown, send to main page
						success: function (data) {
							alert(data);
							if (data.trim() == 'Login Successful.') {
								location.reload();
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