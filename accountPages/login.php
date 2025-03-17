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
include '../includes/nav.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div id="container">
    <div class="logo">
        <div class="logotext">
            <p>DECK BUDDY<p>
        </div>
    </div>
    <div class="search">
        <div class="headText">
            <p>Welcome! Please enter login details.</p>
        </div>
    </div>
    <div class="filter">
        <div  class="accsettings">
            <a href="../index.php">Back</a>
        </div>
    </div>
    <div class="mainbox">
        <form method="POST">
            <div class="formcontainer">
                <div class="user">
                    <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#666666"><path d="M480-481q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM160-160v-94q0-38 19-65t49-41q67-30 128.5-45T480-420q62 0 123 15.5t127.92 44.69q31.3 14.13 50.19 40.97Q800-292 800-254v94H160Zm60-60h520v-34q0-16-9.5-30.5T707-306q-64-31-117-42.5T480-360q-57 0-111 11.5T252-306q-14 7-23 21.5t-9 30.5v34Zm260-321q39 0 64.5-25.5T570-631q0-39-25.5-64.5T480-721q-39 0-64.5 25.5T390-631q0 39 25.5 64.5T480-541Zm0-90Zm0 411Z"/></svg><input type="text" name="name" placeholder="Username">
                </div>
                <div class="pass">
                    <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#666666"><path d="M280-412q-28 0-48-20t-20-48q0-28 20-48t48-20q28 0 48 20t20 48q0 28-20 48t-48 20Zm0 172q-100 0-170-70T40-480q0-100 70-170t170-70q72 0 126 34t85 103h356l113 113-167 153-88-64-88 64-75-60h-51q-25 60-78.5 98.5T280-240Zm0-60q58 0 107-38.5t63-98.5h114l54 45 88-63 82 62 85-79-51-51H450q-12-56-60-96.5T280-660q-75 0-127.5 52.5T100-480q0 75 52.5 127.5T280-300Z"/></svg><input type="password" name="password" placeholder="Password">
                    <div class="eye">
                        <svg id="eye" xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#666666"><path d="M480.12-330q70.88 0 120.38-49.62t49.5-120.5q0-70.88-49.62-120.38T479.88-670Q409-670 359.5-620.38T310-499.88q0 70.88 49.62 120.38t120.5 49.5Zm-.36-58q-46.76 0-79.26-32.74-32.5-32.73-32.5-79.5 0-46.76 32.74-79.26 32.73-32.5 79.5-32.5 46.76 0 79.26 32.74 32.5 32.73 32.5 79.5 0 46.76-32.74 79.26-32.73 32.5-79.5 32.5Zm.24 188q-146 0-264-83T40-500q58-134 176-217t264-83q146 0 264 83t176 217q-58 134-176 217t-264 83Zm0-300Zm-.17 240Q601-260 702.5-325.5 804-391 857-500q-53-109-154.33-174.5Q601.34-740 480.17-740T257.5-674.5Q156-609 102-500q54 109 155.33 174.5Q358.66-260 479.83-260Z"/></svg>
                    </div>
                </div>
                
                <div class="errLog">
                    <input type="submit" name="login" value="Log In">
                    <div class="error">
                        <?php echo $error?></p>
                    </div>
                </div>
            </div>
        </form>    
    </div>
    <div class="cardinfo"></div>
    <div class="footer"></div>

</div>

<script>
    const btn = document.getElementById("eye");
    var pass = document.querySelector("input[type=password]");
    btn.addEventListener('click', function(){
        if (pass.type === "password"){
            pass.type = "text";
        }
        else{
            pass.type = "password";
        }
    });
    btn.addEventListener('mouseover', function(){
        btn.setAttribute('fill', '#bf0000');
    });
    btn.addEventListener('mouseout', function(){
        btn.setAttribute('fill', '#666666');
    });
</script>
</body>
</html>





