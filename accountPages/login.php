<?php 
session_start();


 
include '../model/functions.php';

$email = "";
$name = "";
$password = "";
$id = "";
$users = "";

$_session['isLoggedIn'] = false;
$error = '';

if(isset($_POST['login'])){
    $name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);

    $_SESSION['name'] = $name;
    $_SESSION['password'] = $password;
    if(login($name, $password)){
        $user = login($name, $password);
        $_SESSION['user'] = $user;
        header('location: ../homepage.php');
    }
    else{
        $error = "Error! Incorrect credentials.";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div id="container">
        <div class="mainbox">
            
            <div class="header2">
                <div class="headText">
                    <p>Welcome</p>
                </div>
                <p class="infp">Please enter your login details</p>
            </div>
            
            <form method="POST">
                <div class="formcontainer">
                    <div class="user">
                        <input type="text" name="name" placeholder="example@mail@gmail.com">
                    </div>
                    <div class="pass">
                        <input type="password" name="password" placeholder="enter password">
                    </div>

                    
                    <div class="remember">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember Me?</label>
                    </div>
                    
                    <div class="errLog">
                        <div class="submit-wrapper">
                            <input type="submit" value="">
                            <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.31 6.71a.996.996 0 0 0 0 1.41L13.19 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.72 6.7c-.38-.38-1.02-.38-1.41.01"/></svg>
                        </div>
                        <div class="error">
                            <?php echo $error?>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="filter">
                <div class="accsettings">
                    <a href="../index.php">Back</a>
                </div>
            </div>
        </div>
        
        <div class="cardinfo"></div>
    </div>
    
    <script>
        const btn = document.getElementById("eye");
        var pass = document.querySelector("input[type=password]");
        
        if (btn) {
            btn.addEventListener('click', function(){
                if (pass.type === "password"){
                    pass.type = "text";
                }
                else{
                    pass.type = "password";
                }
            });
            
            btn.addEventListener('mouseover', function(){
                btn.setAttribute('fill', '#ff453a');
            });
            
            btn.addEventListener('mouseout', function(){
                btn.setAttribute('fill', '#666666');
            });
        }
    </script>
</body>
</html>





