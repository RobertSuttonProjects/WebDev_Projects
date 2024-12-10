filter = "show_games"

document.addEventListener("DOMContentLoaded", () => {
    newGameForm()
    showGame()
    clearInterval()
    setInterval(showGame, 10000)
});

function filterGames(id) {
    switch (id) {
        case 1:
            filter = "show_games"
            break;
        case 2:
            filter = "show_games_started"
            break;
        case 3:
            filter = "show_games_completed"
            break;
    }
    showGame()
}

function newGameForm() {
    document.querySelector("#gameForm").addEventListener('submit', async function (e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        formData.append("action", "new_game");
        form.reset()
        await fetch('classes/showGames.php', {
            method: 'POST',
            body: formData,
        });
        showGame()
    })
}

async function showGame() {
    const data = new FormData();
    console.log(filter)
    data.append("action", filter);

    const response = await fetch("classes/showGames.php", {
        method: "POST",
        body: data,
    });

    const games = await response.json();
    let gameDiv = document.querySelector("#games-content")
    console.log(games)
    gameDiv.innerHTML = "";
    for (let i = 0; i < games.length; i++) {
        let divElement = document.createElement("div");
        divElement.className = "gamePF";
        let dateStarted = games[i].date_started;
        let dateCompleted = games[i].date_completed;
        if (!dateStarted) {
            dateStarted = "Not Started"
        }
        if (!dateCompleted) {
            dateCompleted = "Not Complete"
        }
        divElement.innerHTML =
            `
            <div class = "words">
                <p id="game_title"><span id="gameName${i}">${games[i].game_name}</span></p>
                <p><span id="platform${i}">${games[i].game_platform}</span></p>
                <p><span id="dateAdded${i}">${games[i].date_created}</span></p>
                <p><span id="dateStarted${i}">${dateStarted}</span></p>
                <p><span id="dateComplete${i}">${dateCompleted}</span></p>
            </div>

            <div class = "buttons">
                <button id="startGame${i}">Start Game</button>
                <button id="completeGame${i}">Complete Game</button>
                <button id="deleteGame${i}">Delete Game</button>
            </div>
        `
        gameDiv.appendChild(divElement);

        const startGameButton = divElement.querySelector(`#startGame${i}`);
        const completeGameButton = divElement.querySelector(`#completeGame${i}`);
        const deleteGamebutton = divElement.querySelector(`#deleteGame${i}`);

        startGameButton.addEventListener("click", async () => {
            await buttonAction(games[i].backlog_id, "start_game");
            showGame()
        });
        completeGameButton.addEventListener("click", async () => {
            await buttonAction(games[i].backlog_id, "complete_game");
            showGame()
        });
        deleteGamebutton.addEventListener("click", async () => {
            await buttonAction(games[i].backlog_id, "delete_game");
            showGame()
        });
    }
}

async function buttonAction($gameID, $action) {
    const data = new FormData();
    data.append("action", $action);
    data.append("game_id", $gameID);

    const response = await fetch("classes/showGames.php", {
        method: "POST",
        body: data,
    });
}
