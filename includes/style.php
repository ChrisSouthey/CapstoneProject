<style>
/* General Reset */
body, h1, h2, h3, p, ul, ol, li {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f9f9f9;
    color: #333;
    margin: 0;
}

/* Header Styling */
.header {
    background-color: #4CAF50;
    color: white;
    padding: 1rem 0;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.logo h1 {
    margin: 0;
    font-size: 2rem;
}

/* Footer Styling */
.footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 0.5rem 0;
    position: fixed;
    bottom: 0;
    width: 100%;
    font-size: 0.9rem;
}

/* Main Container */
.main-container {
    display: flex;
    flex-wrap: wrap;
    padding: 1rem;
    margin-bottom: 2rem; /* Space above the footer */
}

/* Search Section */
.search {
    width: 100%;
    margin-bottom: 1.5rem;
    text-align: center;
}

#searchBar {
    width: 60%;
    padding: 0.75rem;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 0.5rem;
    margin-right: 0.5rem;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}

#searchBtn {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#searchBtn:hover {
    background-color: #45a049;
}

/* Filter Section */
.filter {
    width: 25%;
    padding: 1rem;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 0.5rem;
    margin-right: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.filter h3 {
    margin-bottom: 1rem;
}

.filter form label {
    display: block;
    margin: 0.5rem 0 0.25rem;
    font-weight: bold;
}

.filter form select,
.filter form button {
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 0.5rem;
    background-color: #f9f9f9;
    transition: box-shadow 0.3s ease;
}

.filter form select:focus,
.filter form button:focus {
    box-shadow: 0 0 4px #4CAF50;
    outline: none;
}

.filter form button {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.filter form button:hover {
    background-color: #45a049;
}

/* Mainbox Section */
.mainbox {
    flex: 1;
    padding: 1rem;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.mainbox h2 {
    margin-bottom: 1rem;
    font-size: 1.5rem;
    color: #4CAF50;
    text-align: center;
}

.cardinfo {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 1rem;
    width: calc(33.333% - 1rem);
    text-align: center;
}

.card h3 {
    margin-bottom: 0.5rem;
    font-size: 1.25rem;
    color: #333;
}

.card p {
    margin: 0.5rem 0;
    font-size: 1rem;
    color: #555;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .filter {
        width: 30%;
    }

    .card {
        width: calc(50% - 1rem);
    }
}

@media (max-width: 768px) {
    .filter {
        width: 100%;
        margin-right: 0;
        margin-bottom: 1rem;
    }

    .card {
        width: calc(50% - 1rem);
    }
}

@media (max-width: 480px) {
    .card {
        width: 100%;
    }
}
