<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="CSS/loginstyle.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!--Boottrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
  <!--Boottrap CSS-->
    
</head>



<body>

<?php
session_start();
?>

<?php
$password = $email = $message = "";
include_once "loginprocess.php";
//var_dump($_SESSION['session_user']);
?>
  

  <!--Login page-->

  <div class="loginpage">
    <h1>Login</h1>
    <form class="row g-3 needs-validation" id="login" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

      <div class="form-group col-md-12">
        <label for="validationDefaultUsername" class="form-label">Username</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="inputGroupPrepend2" value="Enter your email address"
          required>
      </div>

      <div class="form-group col-md-12">
        <label for="exampleInputPassword1" class="form-label">Password</label> 
          <input type="password" class="form-control" id="password" name="password" required pattern = "(?=.*\d)(?=.*[!,@,#,$,%])(?=.*[A-Za-z]).{6,12}" title = "Must contain at least one number, one letters ,one of following special characters() ! @ # $ % ) and between 6 and 12 characters">
       </div>

      <div class="d-grid gap-2">
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>

      <div class="password form-group col-md-12">
        <p id="message" name="message"><?= $message ?></p>
      </div>
      

    </form>
    
  </div>
  <!--Login page-->


</body>

</html>