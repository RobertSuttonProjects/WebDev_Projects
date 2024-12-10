
<?php
/*
This CLASS contains-

- newGame(GameName, GamePlatform, isStarting)
- getGameRow(GameID)
- startGame(GameID)
- completeGame(GameID)
- getAllGames()
- isNewGame(GameName)


-maybe
-deleteGame(GameID)
*/
function newGame($game_name, $game_platform, $isStarting)
{
    if (isNewGame($game_name)) {
        $currentDate = date("Y-m-d H:i:s");
        $currentUser = $_SESSION["user-id"];
        require("Database.php");
        $sql = "
        INSERT INTO backlog (`user_id`, `date_created`, `game_name`, `game_platform`, `date_started`, `date_completed`)
        VALUES (:user_id, :date_created, :game_name, :game_platform, :date_started, :date_completed)";
        $query = $dbh->prepare($sql);
        $query->bindValue(":user_id", $currentUser);
        $query->bindValue(':date_created', $currentDate);
        $query->bindValue(':game_name', $game_name);
        $query->bindValue(':game_platform', $game_platform);
        $query->bindValue(':date_started', null);
        $query->bindValue(':date_completed', null);

        if ($isStarting) {
            $query->bindValue(':date_started', $currentDate);
        }
        return $query->execute();
    }
}
//may not be used
function getGameRow($gameID)
{
    require("Database.php");
    $sql = "SELECT * FROM backlog WHERE game_id = :game_id";
    $query = $dbh->prepare($sql);
    $query->bindValue(":game_id", $gameID);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function startGame($gameID)
{
    require("Database.php");
    $currentDate = date("Y-m-d H:i:s");
    $sql = "UPDATE backlog SET date_started = :date_started WHERE backlog_id = :backlog_id";
    $query = $dbh->prepare($sql);
    $query->bindValue(":backlog_id", $gameID);
    $query->bindValue(":date_started", $currentDate);
    return $query->execute();
}

function completeGame($gameID)
{
    require("Database.php");
    $currentDate = date("Y-m-d H:i:s");
    $sql = "UPDATE backlog SET date_completed = :date_completed WHERE backlog_id = :backlog_id";
    $query = $dbh->prepare($sql);
    $query->bindValue(":backlog_id", $gameID);
    $query->bindValue(":date_completed", $currentDate);
    return $query->execute();
}

function deleteGame($gameID){
    require("Database.php");
    $currentDate = date("Y-m-d H:i:s");
    $sql = "DELETE FROM backlog WHERE backlog_id = :backlog_id";
    $query = $dbh->prepare($sql);
    $query->bindValue(":backlog_id", $gameID);
    return $query->execute();
}

//change to only games the individual owner has
function getAllGames()
{
    $currentUser = $_SESSION["user-id"];
    require("Database.php");
    $sql = "SELECT * FROM backlog WHERE user_id = :user_id";
    $query = $dbh->prepare($sql);
    $query->bindValue(":user_id", $currentUser);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getAllGamesCompleted()
{
    $currentUser = $_SESSION["user-id"];
    require("Database.php");
    $sql = "SELECT * FROM backlog WHERE user_id = :user_id AND date_completed IS NOT NULL";
    $query = $dbh->prepare($sql);
    $query->bindValue(":user_id", $currentUser);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getAllGamesStarted()
{
    $currentUser = $_SESSION["user-id"];
    require("Database.php");
    $sql = "SELECT * FROM backlog WHERE user_id = :user_id AND date_started IS NOT NULL AND date_completed IS NULL";
    $query = $dbh->prepare($sql);
    $query->bindValue(":user_id", $currentUser);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function isNewGame($game_name)
{
    $currentUser = $_SESSION["user-id"];
    require("Database.php");
    $sql = "SELECT * FROM backlog WHERE game_name = :game_name AND user_id = :user_id";
    $query = $dbh->prepare($sql);
    $query->bindValue(":game_name", $game_name);
    $query->bindValue(":user_id", $currentUser);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC) === false;
}

