<?php
    // core configuration
    include_once "config/core.php";

    // set page title
    $page_title = "Login";

    // include login checker
    $require_login = false;
    include_once "login_checker.php";

    // default to false
    $access_denied = false;
    // if the login form was submitted
    if($_POST){
        // email check will be here
        // include classes
        include_once "config/database.php";
        include_once "objects/user.php";
        
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // initialize objects
        $user = new User($db);
        
        // check if email and password are in the database
        $user->email=$_POST['email'];
        
        // check if email exists, also get user details using this emailExists() method
        $email_exists = $user->emailExists();
        
        // login validation will be here
        // validate login
        if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status==1){
        
            // if it is, set the session value to true
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['access_level'] = $user->access_level;
            $_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8') ;
            $_SESSION['lastname'] = $user->lastname;
        
            // if access level is 'Admin', redirect to admin section
            if($user->access_level=='Admin'){
                header("Location: {$home_url}admin/index.php?action=login_success");
            }
        
            // else, redirect only to 'Customer' section
            else{
                header("Location: {$home_url}index.php?action=login_success");
            }
        }
        
        // if username does not exist or password is wrong
        else{
            $access_denied=true;
        }
    }
    ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="main.css" rel="stylesheet">
    <style>
      .container {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%); /* for IE 9 */
        -webkit-transform: translate(-50%, -50%); /* for Safari */
        }
        .card, .message{
            max-width: 600px;
            margin: 0 auto;
        }
        </style>
</head>
<body>
    <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align:center">
                    <img src="images/logo.png" height="50">
                </div>
                <div class="col-md-12" style="text-align:center">
                    <i>Library. The world's largest ebook library</i>
                </div>
            </div><br><br>
            <div class="row message">
                <div class="col-md-12">
                   <?php
                        // get 'action' value in url parameter to display corresponding prompt messages
                        $action=isset($_GET['action']) ? $_GET['action'] : "";
                        
                        // tell the user he is not yet logged in
                        if($action =='not_yet_logged_in'){
                            echo "<div class='alert alert-danger margin-top-40' role='alert'>Please login.</div>";
                        }
                        
                        // tell the user to login
                        else if($action=='please_login'){
                            echo "<div class='alert alert-info'>
                                <strong>Please login to access that page.</strong>
                            </div>";
                        }
                        
                        // tell the user email is verified
                        else if($action=='email_verified'){
                            echo "<div class='alert alert-success'>
                                <strong>Your email address have been validated.</strong>
                            </div>";
                        }
                        
                        // tell the user if access denied
                        if($access_denied){
                            echo "<div class='alert alert-danger margin-top-40' role='alert'>
                                Access Denied.<br /><br />
                                Your username or password maybe incorrect
                            </div>";
                        }
                   ?>
                </div>
            </div>  
        <div class="row">
            <div class="col-md-12">
            <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <form class="" method="POST" action="">
                    <div class="position-relative row form-group"><label for="exampleEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10"><input name="email" id="exampleEmail" placeholder="example@gmail.com" type="email" class="form-control"></div>
                    </div>
                    <div class="position-relative row form-group"><label for="examplePassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10"><input name="password" id="examplePassword" placeholder="********" type="password" class="form-control"></div>
                    </div>

                    <div class="position-relative row form-check">
                        <div class="col-sm-10 offset-sm-2">
                            <input type="submit" value="Login" class="btn btn-primary"/>

                        </div>
                    </div>
                </form>
            </div>
        </div>
       </div>
        </div>


        <div style=" padding: 20px">
            <div class="row">
                <div class="col-md-12" style="text-align:center">
                        <i>Copyright 2022 SOUTRUOSHIM All right reversed.</i>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
