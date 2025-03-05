<?php 
session_start();

include '../includes/header.php'; 
include '../model/functions.php';

$name = "";
$password = "";
$email = "";
$regex = "/^\\S+@\\S+\\.\\S+$/";
$error = "";


$id = filter_input(INPUT_GET,'ID');
$user = getUser($id);


if($user){
    $name = $user['name'];
    $password = $user['password'];
    $email = $user['email'];
}

$pass = $_SESSION['password'];
$game = $_SESSION['game'];
//var_dump($game);


if(isset($_POST["edit"])){
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

    if(isset($_POST['name'])){
        $name = filter_input(INPUT_POST, 'name');
        $password = filter_input(INPUT_POST, 'password');
        $email = filter_input(INPUT_POST, 'email');

        if($error == ""){
        updateUser($id, $email, $name, $password);
        $_SESSION['password'] = $password;
        $_SESSION['name'] = $name;
        header('Location: ../homepage.php');
        exit(); 
        }
    }
}

include '../includes/style grid.php'; 
?>



<div id="container">
    <div class="logo">
        <div class="logotext">
            <p>DECK BUDDY<p>
        </div>
    </div>
    <div class="search">
        <div class="headText">
            <p>Your ultimate card game database.</p>
        </div>
    </div>
    <div class="left">
        <div class="filter">

        </div>
        <div  class="accsettings">
            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#ffffff"><path d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.81-195q-57.81 0-97.31-39.69-39.5-39.68-39.5-97.5 0-57.81 39.69-97.31 39.68-39.5 97.5-39.5 57.81 0 97.31 39.69 39.5 39.68 39.5 97.5 0 57.81-39.69 97.31-39.68 39.5-97.5 39.5Zm.66 370Q398-80 325-111.5t-127.5-86q-54.5-54.5-86-127.27Q80-397.53 80-480.27 80-563 111.5-635.5q31.5-72.5 86-127t127.27-86q72.76-31.5 155.5-31.5 82.73 0 155.23 31.5 72.5 31.5 127 86t86 127.03q31.5 72.53 31.5 155T848.5-325q-31.5 73-86 127.5t-127.03 86Q562.94-80 480.47-80Zm-.47-60q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z"/></svg><a href="../homepage.php?game=<?= $game ?>">Back</a><p class="pipe">|</p><a href="logout.php" class="logout">Logout</a>
        </div>
    </div>
    <div class="mainbox">
    <form method="POST">
            <div class="formcontainer">
                <div class="user">
                    <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#666666"><path d="M480-481q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM160-160v-94q0-38 19-65t49-41q67-30 128.5-45T480-420q62 0 123 15.5t127.92 44.69q31.3 14.13 50.19 40.97Q800-292 800-254v94H160Zm60-60h520v-34q0-16-9.5-30.5T707-306q-64-31-117-42.5T480-360q-57 0-111 11.5T252-306q-14 7-23 21.5t-9 30.5v34Zm260-321q39 0 64.5-25.5T570-631q0-39-25.5-64.5T480-721q-39 0-64.5 25.5T390-631q0 39 25.5 64.5T480-541Zm0-90Zm0 411Z"/></svg><input type="text" name="name" placeholder="Username" value="<?= $name; ?>">
                </div>
                <div class="pass">
                    <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#666666"><path d="M280-412q-28 0-48-20t-20-48q0-28 20-48t48-20q28 0 48 20t20 48q0 28-20 48t-48 20Zm0 172q-100 0-170-70T40-480q0-100 70-170t170-70q72 0 126 34t85 103h356l113 113-167 153-88-64-88 64-75-60h-51q-25 60-78.5 98.5T280-240Zm0-60q58 0 107-38.5t63-98.5h114l54 45 88-63 82 62 85-79-51-51H450q-12-56-60-96.5T280-660q-75 0-127.5 52.5T100-480q0 75 52.5 127.5T280-300Z"/></svg><input type="password" id="pass" name="password" placeholder="Password" value="<?= $pass; ?>">
                    <div class="eye">
                        <svg id="eye" xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#666666"><path d="M480.12-330q70.88 0 120.38-49.62t49.5-120.5q0-70.88-49.62-120.38T479.88-670Q409-670 359.5-620.38T310-499.88q0 70.88 49.62 120.38t120.5 49.5Zm-.36-58q-46.76 0-79.26-32.74-32.5-32.73-32.5-79.5 0-46.76 32.74-79.26 32.73-32.5 79.5-32.5 46.76 0 79.26 32.74 32.5 32.73 32.5 79.5 0 46.76-32.74 79.26-32.73 32.5-79.5 32.5Zm.24 188q-146 0-264-83T40-500q58-134 176-217t264-83q146 0 264 83t176 217q-58 134-176 217t-264 83Zm0-300Zm-.17 240Q601-260 702.5-325.5 804-391 857-500q-53-109-154.33-174.5Q601.34-740 480.17-740T257.5-674.5Q156-609 102-500q54 109 155.33 174.5Q358.66-260 479.83-260Z"/></svg>
                    </div>
                </div>
                <div class="user">
                <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#666666"><path d="M140-160q-24 0-42-18t-18-42v-520q0-24 18-42t42-18h680q24 0 42 18t18 42v520q0 24-18 42t-42 18H140Zm340-302L140-685v465h680v-465L480-462Zm0-60 336-218H145l335 218ZM140-685v-55 520-465Z"/></svg><input type="text" name="email" placeholder="Email" value="<?= $email; ?>">
                </div>
                <div class="errLog">
                    <input type="submit" name="edit" value="Confirm Changes">
                    <div class="error">
                        <?php echo $error?></p>
                    </div>
                </div>
            </div>
        </form>    

    </div>
    <div class="cardinfo">

    </div>

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


    var log = document.querySelector('.logout');
    log.addEventListener('click', function(){
        localStorage.clear();
    })
</script>


<?php include '../includes/footer.php'; ?>