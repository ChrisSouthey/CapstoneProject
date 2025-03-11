<?php 
// Start the session and include necessary files
session_start();
include 'includes/header.php';
include 'includes/style homepage.php';
include 'model/functions.php';

// Get session variables and input parameters for search functionality
$userID = $_SESSION['user']['id'];
$game = filter_input(INPUT_GET, 'game');
$entry = filter_input(INPUT_POST, 'search');
$search = strtolower(str_replace(" ", '-', $entry));
$error = "";

$cardImg = "";
$cardName = "";
$cardID = "";
$cardType = "";
$cardRarity = "";
$cardColor = "";
$selCard = filter_input(INPUT_GET, 'card');

// Get groups (collections) for the user from the database
$groupName = "";
$img = "";
$groups = getGroups($userID);
$_SESSION['game'] = $game;

// API key
$apiKey = "2f519d7b5e1fefc31c708df4179a0bebe5ba7f7548ea7b659c10f7073b1fcb5a";

//-------------------------- SEARCH CODE  --------------------------//
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
                $response = file_get_contents("https://apitcg.com/api/" . $game . "/cards?limit=30", false, $context); 
            }
        }
        else{
            if($game == "magic"){
                $search = strtolower(str_replace("-", '_', $search));
                $response = file_get_contents("https://api.magicthegathering.io/v1/cards/?name=" . $search);
            }
            else{
                $response = file_get_contents("https://apitcg.com/api/" . $game . "/cards?name=" . $search . "&limit=30", false, $context);
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
                    $cardImg = $card['imageUrl'];
                    $cardID = $card['multiverseid'];
                }
            }
            else{
                foreach ($results['data'] as $card) {
                    $cardName = $card['name'];
                    $cardImg = $card['images']['small'];
                    $cardID = $card['id'];
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

if (isset($_GET['group']) && isset($_GET['img'])) {
    $groupName = filter_input(INPUT_GET, 'group');
    $img = filter_input(INPUT_GET, 'img', FILTER_SANITIZE_URL);

    addCard($groupName, $img);
    echo "WOOHOO";
} else {
    $error = "Please select a group.";
}

//------------Var dump graveyard/ Please dont fucking delete this-----------
//var_dump($cardID);
//var_dump($groups);
//var_dump($group);
//var_dump($error); 
//var_dump($results);
//var_dump($cardName, $cardImg);
//var_dump($search);
?>


<div id="container">
    <!-- Logo Section -->
    <div class="logo">
        <div class="logotext">
            <p>DECK BUDDY</p>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search">
        <div class="bar">
            <div class="barflex">
                
                <!-- Search Form -->
                <form method="POST">
                    <input type="text" name="search" class="sbar" placeholder="Search for a Card">
                </form>
            </div>
            
            <!-- Error Display Box -->
            <div class="errorbox">
                <div class="erbx">
                    <p class="errmsg"><?php echo $error; ?></p>
                    <button class="ok">OK</button>
                </div>
            </div>
            <!-- Game Selection Dropdown -->
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
        <!-- Filter Section for My Collection -->
        <div class="filter">
            <div class="filtText">
                <p>My Collection</p>
            </div>
            <div style="margin-bottom:10px">
                <form id="filterForm">
                    
                    <label for="gameName">Game Name:</label>
                    <select id="gameName" name="gameName">
                        <option value="">Select a Game</option>
                        <option value="mtg">Magic The Gathering</option>
                        <option value="pokemon">Pokemon</option>
                        <option value="onepiece">One Piece</option>
                    </select>
                    
                    <div id="cardTypeContainer">
                        <h3>Card Type</h3>
                        <div id="cardType" style="margin-bottom:20px"></div>
                    </div>
                    
                    <div id="cardColorContainer">
                        <h3>Card Color</h3>
                        <div id="cardColor" style="margin-bottom:20px"></div>
                    </div>
                    
                    <div id="cardRarityContainer">
                        <h3>Card Rarity</h3>
                        <div id="cardRarity" style="margin-bottom:20px"></div>
                    </div>
                    
                    <button type="submit">Filter Cards</button>
                </form>
            </div>
        </div>

        
        <div class="accsettings">
            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#ffffff">
                <path d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.81-195q-57.81 0-97.31-39.69-39.5-39.68-39.5-97.5 0-57.81 39.69-97.31 39.68-39.5 97.5-39.5 57.81 0 97.31 39.69 39.5 39.68 39.5 97.5 0 57.81-39.69 97.31-39.68 39.5-97.5 39.5Zm.66 370Q398-80 325-111.5t-127.5-86q-54.5-54.5-86-127.27Q80-397.53 80-480.27 80-563 111.5-635.5q31.5-72.5 86-127t127.27-86q72.76-31.5 155.5-31.5 82.73 0 155.23 31.5 72.5 31.5 127 86t86 127.03q31.5 72.53 31.5 155T848.5-325q-31.5 73-86 127.5t-127.03 86Q562.94-80 480.47-80Zm-.47-60q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z"/>
            </svg>
            <a href="accountPages/settings.php?ID=<?= $userID ?>" class="userName"><?= $_SESSION['name']; ?></a>
        </div>
    </div>

    <!-- Main Content Area -->
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
                    <a href="homepage.php?game=<?=$game;?>&group=<?= $group['groupID'];?>"><?= $group['groupName']; ?><br></a>
                    <div class="cards"></div>
                </div>
            <?php endforeach ; ?>
        </div>
    </div>
    <!-- Card Info Section (for API-driven search results) -->
    <div class="cardinfo">
        <?php 
        if (empty($results)) {
            $error = "Results empty";
        } else {
            if($game == "magic"){
                foreach((array) $results['cards'] as $card): ?>
                    <div class="card">
                        <h3 class="cardName"><?php echo htmlspecialchars($card['name']); ?></h3>
                        <a class="cardlink" href="homepage.php?game=<?=$game;?>&group=<?= $group['groupID'];?>&img=<?=$card['imageUrl'];?>">Add Card</a>
                        
                    </div>
                <?php endforeach; 
            } else {
                foreach((array) $results['data'] as $card): ?>
                    <div class="card">
                        <h3 class="cardName"><?php echo htmlspecialchars($card['name']); ?></h3>
                        <img class="cardImg" src="<?php echo htmlspecialchars($card['images']['small']); ?>">
                        <a class="cardlink" href="homepage.php?game=<?=$game;?>&group=<?= $group['groupID'];?>&img=<?=$card['images']['small'];?>" onclick="addCard(<?= $group['groupID'];?>, <?=$card['images']['small'];?>)">Add Card</a>
                    </div>
                <?php endforeach; 
            }
        }
        ?>
    </div>
</div>

<script>
    // Game dropdown: get saved game selection from localStorage and set value
    var gameSel = document.getElementById("game");
    var opt = document.getElementById("opt");
    const selectedGame = localStorage.getItem('gameName');
    if (selectedGame === ""){
        gameSel.value = "none";
    }
    gameSel.value = selectedGame;
    function getGame(){
        var game = gameSel.value;
        localStorage.setItem('gameName', gameSel.value);
        window.location = "homepage.php?game=" + game;
    }
    
    // Add Collection functionality: toggle display of add collection menu on click
    var add = document.querySelector('.add');
    var plus = document.querySelector('.plus');
    var menu = document.getElementById('addmenu');
    add.addEventListener('click', function(){
        if(menu.style.display === 'none'){
            menu.style.display = 'flex';
        } else {
            menu.style.display = 'none';
        }
    });
    add.addEventListener('mouseover', function(){
        add.style.color = '#bf0000';
        plus.setAttribute('fill', 'black');
    });
    add.addEventListener('mouseout', function(){
        add.style.color = 'black';
        plus.setAttribute('fill', '#666666');
    });

    // Loading icon: show loading gif when searching (Enter key), then hide on page load
    var gif = document.querySelector('.loadgif');
    var search = document.querySelector('.sbar');
    search.addEventListener('keydown', function(e){
        if(e.key === 'Enter') gif.style.display = 'block';
    });
    window.addEventListener('load', function(){
        gif.style.display = 'none';
    });

    // Error handling: show error box if message exists, allow dismissal
    var box = document.querySelector('.errorbox');
    var errmsg = document.querySelector('.errmsg');
    var btn = document.querySelector('.ok');
    if(errmsg.innerHTML !== ""){
        box.style.display = "flex";
        btn.addEventListener('click', function(){
            box.style.display = "none";
        });
    } else {
        box.style.display = "none";
    }

    // ==================== New Filter & Deck Functionality ====================
    // Wait for DOM content to load for filter form and deck preview setup
    document.addEventListener("DOMContentLoaded", function() {
        // Game filter options for the filter form
        const gameOptions = {
            pokemon: {
                cardType: ["Bug", "Dragon", "Electric", "Fighting", "Fire", "Flying", "Ghost", "Grass", "Ground", "Ice", "Normal", "Poison", "Psychic", "Rock", "Water"],
                cardColor: [],
                cardRarity: ["Common", "Uncommon", "Rare", "Rare Holo", "Rare Prime", "Ultra Rare", "Double Rare", "Promo", "Amazing", "Radiant Rare"]
            },
            mtg: {
                cardType: ["Sorcery", "Enchantment", "Planeswalker", "Battle", "Vanguard", "Artifact", "Instant", "Tribal", "Plane", "Scheme", "Creature", "Land", "Dungeon", "Phenomenon"],
                cardColor: ["White", "Blue", "Red", "Black", "Green"],
                cardRarity: ["Common", "Uncommon", "Rare", "Mythic"]
            },
            onepiece: {
                cardType: [],
                cardColor: ["Red", "Green", "Blue", "Purple", "Black", "Yellow"],
                cardRarity: ["Common", "Uncommon", "Rare", "Super Rare", "Secret Rare", "Leader", "Don Cards", "Manga Cards"]
            }
        };

        // References for filter form elements
        const gameNameSelect = document.getElementById("gameName");
        const cardTypeDiv = document.getElementById("cardType");
        const cardColorDiv = document.getElementById("cardColor");
        const cardRarityDiv = document.getElementById("cardRarity");
        const cardColorContainer = document.getElementById("cardColorContainer");

        // Update checkboxes in filter form based on selected game
        function updateFilters(selectedGame) {
            cardTypeDiv.innerHTML = "";
            cardColorDiv.innerHTML = "";
            cardRarityDiv.innerHTML = "";
            if (!selectedGame || !gameOptions[selectedGame]) {
                cardColorContainer.style.display = "block";
                return;
            }
            const { cardType, cardColor, cardRarity } = gameOptions[selectedGame];
            addCheckboxes(cardTypeDiv, cardType, "cardType");
            addCheckboxes(cardRarityDiv, cardRarity, "cardRarity");
            if(selectedGame === "pokemon"){
                cardColorContainer.style.display = "none";
            } else {
                cardColorContainer.style.display = "block";
                addCheckboxes(cardColorDiv, cardColor, "cardColor");
            }
            if(selectedGame === "onepiece"){
                cardTypeDiv.style.display = "none";
            } else {
                cardTypeDiv.style.display = "block";
            }
        }

        // Helper function to add checkbox elements
        function addCheckboxes(container, items, name) {
            container.innerHTML = "";
            items.forEach(function(item){
                var label = document.createElement("label");
                var checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.name = name;
                checkbox.value = item;
                label.appendChild(checkbox);
                label.append(item);
                container.appendChild(label);
                container.appendChild(document.createElement("br"));
            });
        }

        // Update filters when the game dropdown in the filter form changes
        gameNameSelect.addEventListener("change", function(){
            updateFilters(gameNameSelect.value);
        });

        // On filter form submission, send selected filters to PHP endpoint (fetch_decks.php)
        document.getElementById("filterForm").addEventListener("submit", function(e){
            e.preventDefault();
            var selectedGame = gameNameSelect.value;
            var selectedFilters = {
                gameName: selectedGame,
                cardType: getCheckedValues("cardType"),
                cardColor: getCheckedValues("cardColor"),
                cardRarity: getCheckedValues("cardRarity")
            };
            console.log("Filters submitted:", selectedFilters);
            document.querySelector('.loadgif').style.display = 'block';
            // Fetch deck data from PHP (plug your SQL logic in fetch_decks.php)
            fetch("fetch_decks.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(selectedFilters)
            })
            .then(function(response){ return response.json(); })
            .then(function(data){
                document.querySelector('.loadgif').style.display = 'none';
                // Update deck preview areas with returned HTML content
                if(data.mtg !== undefined){
                    document.querySelector("#deck-mtg .deck-preview").innerHTML = data.mtg;
                }
                if(data.pokemon !== undefined){
                    document.querySelector("#deck-pokemon .deck-preview").innerHTML = data.pokemon;
                }
                if(data.onepiece !== undefined){
                    document.querySelector("#deck-onepiece .deck-preview").innerHTML = data.onepiece;
                }
            })
            .catch(function(error){
                console.error("Error:", error);
                document.querySelector('.loadgif').style.display = 'none';
            });
        });

        // Helper to get values of checked checkboxes
        function getCheckedValues(name) {
            var checkboxes = document.querySelectorAll('input[name="' + name + '"]:checked');
            var values = [];
            checkboxes.forEach(function(el) {
                values.push(el.value);
            });
            return values;
        }
    });

    // ==================== Deck Preview Toggle Function ====================
    // Toggle the preview area for a given deck by its preview div's id.
    function toggleDeckPreview(previewId) {
        var preview = document.getElementById(previewId);
        var arrow = preview.parentElement.querySelector('.toggle-arrow');
        if(preview.classList.contains('hidden')){
            preview.classList.remove('hidden');
            arrow.innerHTML = "&#9660;";  // Down arrow when open
        } else {
            preview.classList.add('hidden');
            arrow.innerHTML = "&#9654;";  // Right arrow when closed
        }
    }
</script>

<?php include 'includes/footer.php'; ?>
