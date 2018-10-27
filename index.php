<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Welcome</title>
    <meta type="robots" content="noindex">
</head>
<body>

<?php

//error_reporting(0);

    $error_login=$error_signup="";
    if(isset($_POST['login_submit'])){ //checking if 'login' button was clicked
        $username=$_POST['username']; //storing entered data
        $password=$_POST['password']; //storing entered data

            include_once "./connections/connect.php"; //connecting to mysql database

            // this is for students
            $sql="SELECT * FROM student WHERE roll_no='$username' AND password='$password'"; //sql query
            $request=pg_query($db,$sql); //searching for a user with given credentials in the table 'users'

            if(pg_num_rows($request) > 0){ //if user found

                $row = pg_fetch_array($request);
                //correct credentials
                //student: login, level, roll_no, dept, id, name
                $_SESSION['login'] = "success"; //using session variables to remember that user has logged in
                $_SESSION['level'] = "student";
                $_SESSION['roll_no'] = $username; //storing username for further use (if any)
                $_SESSION['dept'] = $row['dept'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];

                header('Location:home.php'); //redirecting user to admin page
                pg_close($handle); //closing MySQL connection
            } else{
                //wrong credentials
                $error_login="Wrong username and/or password"; //storing error in error variable to output on screen
            }

            // this is for staff
            $sql="SELECT * FROM staff WHERE email='$username' AND password='$password'"; //sql query
            $request=pg_query($db,$sql); //searching for a user with given credentials in the table 'users'

            if(pg_num_rows($request) > 0){ //if user found

                $row = pg_fetch_array($request);
                //correct credentials
                //student: login, level, roll_no, dept, id, name
                $_SESSION['login'] = "success"; //using session variables to remember that user has logged in
                $_SESSION['level'] = "staff";
                $_SESSION['email'] = $username; //storing username for further use (if any)
                $_SESSION['designation'] = $row['designation'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];

                header('Location:home.php'); //redirecting user to admin page
                pg_close($handle); //closing MySQL connection
            } else{
                //wrong credentials
                $error_login="Wrong username and/or password"; //storing error in error variable to output on screen
            }

    // } elseif(isset($_POST['signup_submit'])){
    //     $username=$_POST['username'];
    //     $password=$_POST['password'];
    //
    //         include_once "./connections/connect.php";
    //
    //         if(!empty($username) && !empty($password)){
    //             $sql="SELECT * FROM users WHERE username='$username'";
    //             $request=pg_query($handle,$sql);
    //
    //             if(pg_num_rows($request) > 0){
    //                 $error_signup="Username already taken";
    //             } else{
    //                 $sql="INSERT INTO users (username,password) VALUES ('$username','$password')";
    //                 if(pg_query($handle,$sql)){
    //                     $error_signup="User created";
    //                 } else{
    //                     $error_signup="User creation failed";
    //                 }
    //             }
    //         } else{
    //             $error_signup="Please enter valid credentials";
    //         }

    }

?>
    <div id="login-form">
        Log in
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            Username:<br /><input type="text" name="username"/><br />
            Password:<br /><input type="password" name="password"/><br />
            <input type="submit" name="login_submit" value="Login"/><br />
            <?php echo $error_login; // showing error (if any)?>

        </form>
    </div>

    <hr />

    <!-- <div id="signup-form">
        Sign up
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            Username:<br /><input type="text" name="username"/><br />
            Password:<br /><input type="password" name="password"/><br />
            <input type="submit" name="signup_submit" value="Signup"/><br />
            <?php echo $error_signup; // showing error (if any)?>

        </form>
    </div> -->



</body>
</html>
