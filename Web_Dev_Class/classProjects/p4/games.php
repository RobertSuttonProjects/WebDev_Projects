<?php
/*
This page contains-
- Header
- Add Game
- Select Game
    - Start Game
    - Complete Game
    - Delete Game
- Footer

- MUST be signed in to view this page as it needs a user-id
*/
session_start();
require("classes/User.php");
if (!isLoggedIn()) {
    Header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Catalog</title>
    <script src=".main.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require("templates/header.php") ?>

    <form id="gameForm">
        <h3>Add A New Game</h3>
        <h3>Game Name</h3><input type="text" name="game_name" required>
        <h3>Game Platform</h3><input type="text" name="game_platform" required>
        <h3>Click to start now</h3><input type="checkbox" value="true" name="is_starting">
        <input type="submit">
    </form>

    <div id="game-section">
        <h5>Game Filter</h5>
        <div id="game-filter">
            <button onclick="filterGames(1)">All Games</button>
            <button onclick="filterGames(2)">Started Games</button>
            <button onclick="filterGames(3)">Completed Games</button>
        </div>
        <h5>Game List</h5>
        <ul id="show_game_title">
            <li>Name |</li>
            <li>Platform |</li>
            <li>Date Added |</li>
            <li>Date Started |</li>
            <li>Date Complete |</li>
        </ul>

        <div id="games-content"></div>
    </div>

    <?php require("templates/footer.php") ?>
</body>

</html>