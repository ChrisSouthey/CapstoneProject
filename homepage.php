<?php 
session_start();

include 'includes/header.php'; 
include 'includes/style homepage.php'; 
include 'model/functions.php';

$game = filter_input(INPUT_GET,'game');

$url = "https://apitcg.com/api/" . $game . "/cards";
$apiKey = "2f519d7b5e1fefc31c708df4179a0bebe5ba7f7548ea7b659c10f7073b1fcb5a";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ":");
 
$result = curl_exec($ch);
 
echo $result; 


$userID = $_SESSION['user']['id'];

?>

<div id="container">
    <div class="logo">
        <div class="logotext">
            <p>DECK BUDDY<p>
        </div>
    </div>
    <div class="search">
        <div class="bar">
            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#666666"><path d="M796-121 533-384q-30 26-69.96 40.5Q423.08-329 378-329q-108.16 0-183.08-75Q120-479 120-585t75-181q75-75 181.5-75t181 75Q632-691 632-584.85 632-542 618-502q-14 40-42 75l264 262-44 44ZM377-389q81.25 0 138.13-57.5Q572-504 572-585t-56.87-138.5Q458.25-781 377-781q-82.08 0-139.54 57.5Q180-666 180-585t57.46 138.5Q294.92-389 377-389Z"/></svg>
            <form method="POST">
                <input type="text" name="search" placeholder="Search for a Card">
            </form>
            <select id="game" name="game" onchange="getGame()">
                <option id="opt" value="" disabled selected>Select a game</option>
                <option id="opt" value="magic">Magic</option>
                <option id="opt" value="one-piece">One Piece</option>
                <option id="opt" value="pokemon">Pokemon</option>
                <option id="opt" value="union-arena">Union Arena</option>
                <option id="opt" value="dragon-ball-fusion">Dragon Ball Fusion</option>
                <option id="opt" value="digimon">Digimon</option>
            </select>
            <div hidden>
                <p>HELLO</p>
            </div>
        </div>
    </div>
    <div class="left">
        <div class="filter">
            <div class="filtText">
                <p>Filter</p>
            </div>
        </div>
        <div  class="accsettings">
            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#ffffff"><path d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.81-195q-57.81 0-97.31-39.69-39.5-39.68-39.5-97.5 0-57.81 39.69-97.31 39.68-39.5 97.5-39.5 57.81 0 97.31 39.69 39.5 39.68 39.5 97.5 0 57.81-39.69 97.31-39.68 39.5-97.5 39.5Zm.66 370Q398-80 325-111.5t-127.5-86q-54.5-54.5-86-127.27Q80-397.53 80-480.27 80-563 111.5-635.5q31.5-72.5 86-127t127.27-86q72.76-31.5 155.5-31.5 82.73 0 155.23 31.5 72.5 31.5 127 86t86 127.03q31.5 72.53 31.5 155T848.5-325q-31.5 73-86 127.5t-127.03 86Q562.94-80 480.47-80Zm-.47-60q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z"/></svg><a href="accountPages/settings.php?ID=<?= $userID ?>" class="userName"><?= $_SESSION['name']; ?></a>
        </div>
    </div>
    <div class="mainbox">

    </div>
    <div class="cardinfo">

    </div>
    

</div>
<script>
    var gameSel = document.getElementById("game");
    var opt = document.getElementById("opt");
    function getGame(){
        var game = gameSel.value;
        console.log(game);
        window.location = "homepage.php?game=" + game
    }
    opt.addEventListener('onChange', function(){
        var game = gameSel.value;
        console.log(game);
        window.location = "homepage.php?game=" + game
    })
    
    
    
</script>


<?php include 'includes/footer.php'; ?>