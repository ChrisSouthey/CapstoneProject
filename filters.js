document.addEventListener("DOMContentLoaded", () => {
    const gameNameSelect = document.getElementById("gameName");
    const cardTypeDiv = document.getElementById("cardType");
    const cardColorDiv = document.getElementById("cardColor");
    const cardRarityDiv = document.getElementById("cardRarity");
    const cardColorContainer = document.getElementById("cardColorContainer");

    // Mapping for game-specific options
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
        },
        unionarena: {
            cardType: ["Character Cards", "Event Cards", "Field Cards", "Site Cards"],
            cardColor: ["Red", "Blue", "Yellow", "Green", "Purple"],
            cardRarity: ["Common", "Uncommon", "Rare", "Super Rare", "Action Point"]
        },
        dbf: {
            cardType: ["Super", "Earth", "Alien", "Unique", "Villain"],
            cardColor: ["Red", "Blue", "Green", "Yellow"],
            cardRarity: ["Leader Cards", "Common", "Uncommon", "Rare", "Super Rare", "Secret Rare", "Promotion"]
        },
        digimon: {
            cardType: ["Digimon", "Digi-Egg", "Option", "Tamer"],
            cardColor: ["Black", "Blue", "Green", "Purple", "Red", "White", "Yellow", "Colorless"],
            cardRarity: ["Common", "Uncommon", "Rare", "Super Rare", "Secret Rare", "Parallel Art"]
        }
    };

    function updateFilters(selectedGame) {
        // Clear previous filters
        cardTypeDiv.innerHTML = "";
        cardColorDiv.innerHTML = "";
        cardRarityDiv.innerHTML = "";

        if (!selectedGame || !gameOptions[selectedGame]) {
            cardColorContainer.style.display = "block"; // Reset color section visibility
            return;
        }

        const { cardType, cardColor, cardRarity } = gameOptions[selectedGame];

        // Populate checkboxes
        addCheckboxes(cardTypeDiv, cardType, "cardType");
        addCheckboxes(cardRarityDiv, cardRarity, "cardRarity");

        // Hide Card Color if the game is Pokemon for filtering
        if (selectedGame === "pokemon") {
            cardColorContainer.style.display = "none";
        } else {
            cardColorContainer.style.display = "block";
            addCheckboxes(cardColorDiv, cardColor, "cardColor");
        };

        // Hide Card Type if the game is One Piece for filtering
        if (selectedGame === "onepiece") {
            cardTypeDiv.style.display = "none";
        } else {
            cardTypeDiv.style.display = "block";
            addCheckboxes(cardTypeDiv, cardType, "cardType");
        }        
        
    }

    function addCheckboxes(container, items, name) {
        container.innerHTML = ""; 
        items.forEach(item => {
            const label = document.createElement("label");
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = name;
            checkbox.value = item;
            label.appendChild(checkbox);
            label.append(` ${item}`);
            container.appendChild(label);
            container.appendChild(document.createElement("br"));
        });
    }

    // Event listener for dropdown changes
    gameNameSelect.addEventListener("change", () => {
        updateFilters(gameNameSelect.value);
    });

    // Handle form submission (eventually sending to PHP)
    document.getElementById("filterForm").addEventListener("submit", (e) => {
        e.preventDefault();
        const selectedGame = gameNameSelect.value;
        const selectedFilters = {
            gameName: selectedGame,
            cardType: getCheckedValues("cardType"),
            cardColor: getCheckedValues("cardColor"),
            cardRarity: getCheckedValues("cardRarity"),
        };

        console.log("Filters submitted:", selectedFilters);
        // Send to PHP endpoint
        fetch("fetch_cards.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(selectedFilters)
        })
        .then(response => response.json())
        .then(data => console.log("Filtered Results:", data))
        .catch(error => console.error("Error:", error));
    });

    function getCheckedValues(name) {
        return [...document.querySelectorAll(`input[name=${name}]:checked`)].map(el => el.value);
    }
});
