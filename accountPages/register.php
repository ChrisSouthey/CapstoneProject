<?php 
session_start();

include '../model/functions.php';

$name = "";
$password = "";
$email = "";
$regex = "/^\\S+@\\S+\\.\\S+$/";
$error = "";

if(isset($_POST["register"])){
    //INPUT FILTER STUFF
    if(filter_input(INPUT_POST, 'name') != ''){
        $name = filter_input(INPUT_POST, 'name');
    }
    else{
        $error .= 'Please enter a valid Name. <br/>';
    }
    if(filter_input(INPUT_POST, 'password') != '' && strlen(filter_input(INPUT_POST, 'password')) >= 4){
        $password = filter_input(INPUT_POST, 'password');
    }
    else{
        $error .= 'Password must be 4 or more characters. <br/>';
    }
    if(filter_input(INPUT_POST, 'email') != '' && preg_match($regex, filter_input(INPUT_POST, 'email'))){
        $email = filter_input(INPUT_POST, 'email');
    }
    else{
        $error .= 'Please enter valid Email. <br/>';
    }

    if($error == ""){
        addUser($email, $name, $password);
        header('Location: ../accountPages/login.php');
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div id="container">
        <div class="mainbox">
            
            <div class="header2">
                <div class="headText">
                    <p>Register</p>
                </div>
                <p class="infp">Already have an account? <a href="../accountPages/login.php">Login</a></p>
            </div>
            
            <form method="POST">
                <div class="formcontainer">
                    <div class="user">
                        <input type="text" name="name" placeholder="Username" value="<?php echo $name; ?>">
                    </div>
                    <div class="pass">
                        <input type="password" name="password" placeholder="Password">
                        <div class="eye">
                            <svg id="eye" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#666666"><path d="M480.12-330q70.88 0 120.38-49.62t49.5-120.5q0-70.88-49.62-120.38T479.88-670Q409-670 359.5-620.38T310-499.88q0 70.88 49.62 120.38t120.5 49.5Zm-.36-58q-46.76 0-79.26-32.74-32.5-32.73-32.5-79.5 0-46.76 32.74-79.26 32.73-32.5 79.5-32.5 46.76 0 79.26 32.74 32.5 32.73 32.5 79.5 0 46.76-32.74 79.26-32.73 32.5-79.5 32.5Zm.24 188q-146 0-264-83T40-500q58-134 176-217t264-83q146 0 264 83t176 217q-58 134-176 217t-264 83Zm0-300Zm-.17 240Q601-260 702.5-325.5 804-391 857-500q-53-109-154.33-174.5Q601.34-740 480.17-740T257.5-674.5Q156-609 102-500q54 109 155.33 174.5Q358.66-260 479.83-260Z"/></svg>
                        </div>
                    </div>
                    <div class="user">
                        <input type="text" name="email" placeholder="example@email.com" value="<?php echo $email; ?>">
                    </div>
                    
                    <div class="errLog">
                        <div class="submit-wrapper">
                            <input type="submit" name="register" value="">
                            <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.31 6.71a.996.996 0 0 0 0 1.41L13.19 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.72 6.7c-.38-.38-1.02-.38-1.41.01"/></svg>
                        </div>
                        <div class="error">
                            <?php echo $error?>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="bck">
                <div class="bckbtn">
                    <a href="../index.php">Back</a>
                </div>
            </div>
        </div>
        
        <div class="rightR"></div>
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