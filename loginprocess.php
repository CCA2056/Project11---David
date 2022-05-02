<?php
@$email = $_POST['email'];
@$password = $_POST['password'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($email)) {
        $message = '<span style="color: red;">Email is required</span>';
    }

    if (empty($password)) {
        $message = '<span style="color: red;">Password is required</span>';
    }

    if (empty($email) && empty($password)) {
        $message = '<span style="color: red;">Please enter email and password</span>';
    }


    include('db_conn.php');


    $query = "SELECT * FROM user where email='$email' ";
    //echo "$query"; 
    //echo "$password";
    $result = $conn->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    //var_dump( $row, $email, $password );

    if ($row && $row['email'] == $email && password_verify($password, $row['password'])) {
        $_SESSION["email"] = $row['email'];
        $_SESSION['access'] = $row['access'];
        $_SESSION['userID'] = $row['userID'];
        $_SESSION["firstname"] = $row['firstname'];
        $_SESSION["lastname"] = $row['lastname'];
        $_SESSION["mobile"] = $row['mobile'];
        $_SESSION["userID"] = $row['userID'];
        $_SESSION["abn"] = $row['abn'];
        $_SESSION["address"] = $row['address'];
        $_SESSION["country"] = $row['country'];
        $message = '<span style="color: green;">Login Successfully</span>';
        $session_user = $row['email'];
        $_SESSION['session_user'] = $session_user;
        $session_access = $row['access'];
        $_SESSION['user_access'] = $session_access;
        //var_dump($_SESSION['session_user']);
		if($row['access'] != 2) {
			header("Refresh:2;url=index.php");
		} else {
			header("Refresh:2;url=dashboard_sm.php");
		}
    } elseif ($row && $row['email'] == $email) {
        $message = '<span style="color: red;">Invalid Password. Please try again</span>';
    } elseif (!empty($email) && $row['email'] != $email) {
        $message = '<span style="color: red;">We cannot find your account</span>';
    }
}
