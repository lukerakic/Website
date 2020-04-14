<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Study Planner</title>
    <meta charset="utf-8">
    <link rel="icon" href="default_images/icon.png">
    <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,500&display=swap');
    @import "https://use.fontawesome.com/releases/v5.5.0/css/all.css";

body {
  background: url(bg3.jpg) no-repeat center fixed;
  background-size: cover;
  padding: 0;
}

h1 {
  font-family: 'Montserrat';
  font-weight: 300;
  color: black;
  margin: 5px;
}


.box {
  background: rgba(255, 255, 255, 0.8);
  border: 1px solid gray;
  border-radius: 8px;
  width: 20%;
  height: 20%;
  padding: 10px;
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
}

.box input {
  text-indent: 6px;
  color: black;
  width: 40%;
  margin: 4px;
  background: none;
  padding: 6px;
  border: 1px solid black; 
  border-radius: 30px;
  position: relative;
  transform:translate(0, 150%);
  transition: 0.25s;
}

.box input:focus{
  width: 45%;
  border: 1px solid orangered;
  outline: none;
}

.box input[type = "submit"]{
  color: black;
  width: 42%;
  margin: 10px;
  background: none;
  padding: 4px;
  border: 1px solid black; 
  border-radius: 20px;
  position: relative;
  transition: 0.25s;
}

.box input[type = "submit"]:hover {
  width: 47%;
  border: 1px solid orangered;
}

::placeholder {
  font-family: 'Montserrat';
  font-weight: 300;
  color: gray;
}

p {
  font-family: 'Montserrat';
  font-weight: 300;
  font-size: 16px;
  position: relative;
  top: 20%;
  }

.helpblock {
  font-family: 'Montserrat';
  font-weight: 300;
  font-size: 16px;
  margin: 5px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-240%);
}

.form-group img{
    position: absolute;
    top: 38%;
    left: 21%;
}

.form-group i{
    position: absolute;
    top: 51%;
    left: 22%;
}

    </style>
</head>
<body>
    <div class="box">
        <h1>Study Planner</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <img src="default_images/user.png" height="21" width="21">
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="helpblock">
                <span class="help-block"><?php echo $username_err; ?></span>
                <br>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <br>
            <p class="signlink">Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>