<?php 
session_start();

include 'includes/header.php'; 
include 'includes/style homepage.php'; 
include 'model/functions.php';

$userID = $_SESSION['user']['id'];

$game = filter_input(INPUT_GET,'game');
$entry = filter_input(INPUT_POST, 'search');
$search = strtolower(str_replace(" ", '-', $entry));
$error = "";
$cardImg = "";
$cardName = "";
$cardID = "";

$groupName = "";
$groups = getGroups($userID);
$_SESSION['game'] = $game;
//var_dump($_SESSION['game']);

$apiKey = "2f519d7b5e1fefc31c708df4179a0bebe5ba7f7548ea7b659c10f7073b1fcb5a";

//---------------------------------SEARCH STUFF----------------------------------
if(isset($_POST['search'])){
    $game = filter_input(INPUT_GET,'game');
    if($game == ""){
        $error = "Error: Please select a game.";
    }
    else{
        $error = "";
        $options = array('http' => array(
        'method'  => 'GET',
        'header' => 'x-api-key:' . $apiKey
        ));
        $context  = stream_context_create($options);

        if($search == ""){
            if($game == "magic"){
                $response = file_get_contents("https://api.magicthegathering.io/v1/cards");
            }
            else{
                $response = file_get_contents("https://apitcg.com/api/" . $game . "/cards?limit=30",false, $context); 
            }
        }
        else{
            if($game == "magic"){
                $search = strtolower(str_replace("-", '_', $search));
                $response = file_get_contents("https://api.magicthegathering.io/v1/cards/?name=" . $search);
            }
            else{
                $response = file_get_contents("https://apitcg.com/api/" . $game . "/cards?name=" . $search . "&limit=30",false, $context);
            }
        }
        
        
        $results = json_decode($response, true);
        if(empty($results['data'])){
            $error = "Error: No results found";
        }
        else{
            $error = "";
            if($game == "magic"){
                foreach ($results['cards'] as $card){
                    $cardName = $card['name'];
                    $imageUrl = isset($card['imageUrl']) && !empty($card['imageUrl']);
                    $cardID = $card['id'];
                    //var_dump($cardName, $cardImg, $cardID);
                }
            }
            else{
                foreach ($results['data'] as $card) {
                    $cardName = $card['name'];
                    $cardImg = $card['images']['small'];
                    $cardID = $card['id'];
                    //var_dump($cardName, $cardImg, $cardID);
                }
            }
        }
    }
}



if(isset($_POST['subgroup'])){
    $groupName = filter_input(INPUT_POST, 'group');
    $error = addGroup($userID, $groupName);
    $groups = getGroups($userID);
}

//------------Var dump graveyard-----------
//var_dump($groups);
//var_dump($error); 
//var_dump($results);
//var_dump($cardName, $cardImg);
//var_dump($search);
//var_dump($userID);
?>
<script defer src="filters.js"></script>
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
                <input type="text" name="search" class="sbar" placeholder="Search for a Card">
            </form>

            <div class="errorbox">
                <div class="erbx">
                    <p class="errmsg"><?php echo $error ;?></p>
                    <button class="ok">OK</button>
                </div>
            </div>
            
            <select id="game" name="game" onchange="getGame()">
                <option id="opt" value="none" disabled selected>Select a game</option>
                <option id="opt" value="magic">Magic</option>
                <option id="opt" value="one-piece">One Piece</option>
                <option id="opt" value="pokemon">Pokemon</option>
                <option id="opt" value="union-arena">Union Arena</option>
                <option id="opt" value="dragon-ball-fusion">Dragon Ball Fusion</option>
                <option id="opt" value="digimon">Digimon</option>
                <option id="opt" value="gundam">Gundam</option>
            </select>
        </div>
    </div>
    <div class="left">
    <div class="filter">
        <div class="filtText">
            <p>My Collection</p>
        </div>
        <div style="margin-bottom:10px">
        <form id="filterForm">
            <!-- Game Name Dropdown -->
            <label for="gameName">Game Name:</label>
            <select id="gameName" name="gameName">
                <option value="">Select a Game</option>
                <option value="pokemon">Pokemon</option>
                <option value="onepiece">One Piece Trading Card Game</option>
                <option value="mtg">Magic The Gathering</option>
                <option value="unionarena">Union Arena</option>
                <option value="dbf">Dragon Ball Fusion</option>
                <option value="digimon">Digimon</option>
            </select>
        </div>

            <!-- Card Type Checkboxes -->
            <div id="cardTypeContainer">
                <h3>Card Type</h3>
                <div id="cardType" style="margin-bottom:20px">
                </div>
            </div>

            <!-- Card Color Checkboxes -->
            <div id="cardColorContainer">
                <h3>Card Color</h3>
                <div id="cardColor" style="margin-bottom:20px"></div>
            </div>

            <!-- Card Rarity Checkboxes -->
            <div id="cardRarityContainer">
                <h3>Card Rarity</h3>
                <div id="cardRarity" style="margin-bottom:20px"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit">Filter Cards</button>
        </form>
    </div>

        <div  class="accsettings">
            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#ffffff"><path d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.81-195q-57.81 0-97.31-39.69-39.5-39.68-39.5-97.5 0-57.81 39.69-97.31 39.68-39.5 97.5-39.5 57.81 0 97.31 39.69 39.5 39.68 39.5 97.5 0 57.81-39.69 97.31-39.68 39.5-97.5 39.5Zm.66 370Q398-80 325-111.5t-127.5-86q-54.5-54.5-86-127.27Q80-397.53 80-480.27 80-563 111.5-635.5q31.5-72.5 86-127t127.27-86q72.76-31.5 155.5-31.5 82.73 0 155.23 31.5 72.5 31.5 127 86t86 127.03q31.5 72.53 31.5 155T848.5-325q-31.5 73-86 127.5t-127.03 86Q562.94-80 480.47-80Zm-.47-60q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z"/></svg><a href="accountPages/settings.php?ID=<?= $userID ?>" class="userName"><?= $_SESSION['name']; ?></a>
        </div>
    </div>


    <div class="mainbox"> <!--AHHHHHHHHHHHHHHHHHHHHHHhhhhhhhhhhhhhhhhhhhhhhhhhh-->
        <div class="adding">
            <p class="add">Add Collection</p><svg class="plus" xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
            <path d="M19.8333 32.8334H24.1666V24.1667H32.8332V19.8334H24.1666V11.1667H19.8333V19.8334H11.1666V24.1667H19.8333V32.8334ZM21.9999 43.6667C19.0027 43.6667 16.186 43.098 13.5499 41.9605C10.9138 40.823 8.62075 39.2792 6.67075 37.3292C4.72075 35.3792 3.177 33.0862 2.0395 30.45C0.902002 27.8139 0.333252 24.9973 0.333252 22C0.333252 19.0028 0.902002 16.1862 2.0395 13.55C3.177 10.9139 4.72075 8.62087 6.67075 6.67087C8.62075 4.72087 10.9138 3.17712 13.5499 2.03962C16.186 0.902124 19.0027 0.333374 21.9999 0.333374C24.9971 0.333374 27.8138 0.902124 30.4499 2.03962C33.086 3.17712 35.3791 4.72087 37.3291 6.67087C39.2791 8.62087 40.8228 10.9139 41.9603 13.55C43.0978 16.1862 43.6666 19.0028 43.6666 22C43.6666 24.9973 43.0978 27.8139 41.9603 30.45C40.8228 33.0862 39.2791 35.3792 37.3291 37.3292C35.3791 39.2792 33.086 40.823 30.4499 41.9605C27.8138 43.098 24.9971 43.6667 21.9999 43.6667ZM21.9999 39.3334C26.8388 39.3334 30.9374 37.6542 34.2957 34.2959C37.6541 30.9375 39.3332 26.8389 39.3332 22C39.3332 17.1611 37.6541 13.0625 34.2957 9.70421C30.9374 6.34587 26.8388 4.66671 21.9999 4.66671C17.161 4.66671 13.0624 6.34587 9.70408 9.70421C6.34575 13.0625 4.66658 17.1611 4.66658 22C4.66658 26.8389 6.34575 30.9375 9.70408 34.2959C13.0624 37.6542 17.161 39.3334 21.9999 39.3334Z" fill="#666666"/>
            </svg>
        </div>
        <div id="addmenu" class="hidden">
            <form method="POST">
                <input type="text" name="group" class="groupi" placeholder="Enter Group Name">
                <input type="submit" name="subgroup" class="subgroup">
            </form>
        </div>
        <div class="loadgif">
            <img src="https://i.gifer.com/ZKZg.gif" jsaction="" class="sFlh5c FyHeAf iPVvYb" style="max-width: 100px; height: 100px; margin: 0px; width: 100px;" alt="Loading GIFs - Get the best gif on GIFER" jsname="kn3ccd">
        </div>

        <div class="groupcon">
            <?php foreach($groups as $group): ?>
                <div class="groups">
                    <?= $group['groupName']; ?><br>
                    <div class="cards"></div>
                </div>
            <?php endforeach ; ?>
        </div>
    </div>

    
    <div class="cardinfo">
    <?php 
    //var_dump($results['data']);
    if (empty($results)) {
        $error = "Results empty";
    } 
    else{
        if($game == "magic"){
            foreach((array) $results['cards'] as $card): ?>
            <div class="card">
                <h3 class="cardName"><?php echo htmlspecialchars($card['name']); ?></h3>
                <img class="cardImg" src="<?php echo !empty($card['imageUrl']) ? htmlspecialchars($card['imageUrl']) : 'includes/Magic_card_back.png'; ?>">
            </div>
            <?php endforeach; 
        }
        else{
            foreach((array) $results['data'] as $card): ?>
            <div class="card">
                <h3 class="cardName"><?php echo htmlspecialchars($card['name']); ?></h3>
                <img class="cardImg" src="<?php echo htmlspecialchars($card['images']['small']); ?>">
            </div>
            <?php endforeach; 
        }
        
    }
?>

    </div>
    

</div>

<script>
    //Getting game value from dropdown 
    var gameSel = document.getElementById("game");
    var opt = document.getElementById("opt");
    const selectedGame = localStorage.getItem('gameName');
    if (selectedGame === ""){
        gameSel.value = "none"
    }
    gameSel.value = selectedGame;
    function getGame(){
        var game = gameSel.value;
        localStorage.setItem('gameName', gameSel.value);
        window.location = "homepage.php?game=" + game;
    }
    
    //Adding a collection stuff
    var add = document.querySelector('.add');
    var plus = document.querySelector('.plus')
    var menu = document.getElementById('addmenu')
    add.addEventListener('click', function(){
        if(menu.style.display === 'none'){
            menu.style.display = 'flex';
        }
        else{
            menu.style.display = 'none';
        }
    })
    add.addEventListener('mouseover', function(){
        add.style.color = '#bf0000'
        plus.setAttribute('fill', 'black')
    })
    add.addEventListener('mouseout', function(){
        add.style.color = 'black'
        plus.setAttribute('fill', '#666666');
    })

    //Loading icon stuff :3
    var gif = document.querySelector('.loadgif');
    var search = document.querySelector('.sbar');
    var body = document.querySelector('body');
    search.addEventListener('keydown', function(e){
        if(e.key === 'Enter')gif.style.display = 'block';
        
    })
    window.addEventListener('load', function(){
            gif.style.display = 'none';
        })

    //Error handling stuff
    var box = document.querySelector('.errorbox');
    var errmsg = document.querySelector('.errmsg');
    var btn = document.querySelector('.ok');
    if(errmsg.innerHTML !== ""){
        box.style.display = "flex";
        btn.addEventListener('click', function(){
            box.style.display = "none";
        })
    }
    else{
        box.style.display = "none";
    }
    
    //Filter stuff
    function toggleDropdown(id) {
        var content = document.getElementById(id);
        var header = content.previousElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
            header.innerHTML = "&#9654; " + header.innerHTML.slice(2);
        } else {
            content.style.display = "block";
            header.innerHTML = "&#9660; " + header.innerHTML.slice(2);
        }
    }
    
    
    
</script>


<?php include 'includes/footer.php'; ?>