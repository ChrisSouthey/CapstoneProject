<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo">
            <h1>Website Title</h1>
        </div>
    </div>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Search Section -->
        <div class="search">
            <form action="search.php" method="GET">
                <input type="text" id="searchBar" name="query" placeholder="Search...">
                <button id="searchBtn" type="submit">Search</button>
            </form>
        </div>

        <!-- Filter Section -->
        <div class="filter">
            <h3>Filter Options</h3>
            <form action="filter.php" method="POST">
                <label for="category">Category:</label>
                <select id="category" name="category">
                    <option value="all">All</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
                <button type="submit">Apply Filter</button>
            </form>
        </div>

        <!-- Main Content Section -->
        <div class="mainbox">
            <h2>Main Content</h2>
            <div class="cardinfo">
                <!-- Example Card 1 -->
                <div class="card">
                    <h3>Card Title 1</h3>
                    <p>Some content for card 1 goes here.</p>
                </div>
                <!-- Example Card 2 -->
                <div class="card">
                    <h3>Card Title 2</h3>
                    <p>Some content for card 2 goes here.</p>
                </div>
                <!-- Example Card 3 -->
                <div class="card">
                    <h3>Card Title 3</h3>
                    <p>Some content for card 3 goes here.</p>
                </div>
                <!-- Add more cards as needed -->
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Your Website. All rights reserved.</p>
    </div>

</body>
</html>
