<?php
$itemID = isset($_GET['id']) ? $_GET['id'] : "";
$itemMediaType = isset($_GET['media_type']) ? $_GET['media_type'] : "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <script>
        let itemID = <?php echo $itemID ?>;
        let mediaType = <?php echo "\"" . $itemMediaType . "\""; ?>;
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/1481fced47.js" crossorigin="anonymous"></script>
    <script src="assets/scripts/main.js"></script>
    <script>
        if (mediaType === "movie") {
            loadMovieDetails(itemID, mediaType)
        } else if (mediaType === "tv") {
            loadTvDetails(itemID, mediaType)
        }
    </script>
    <link rel="stylesheet" href="assets/styles/style.css">
</head>

<body>
<?php include("assets/templates/header.php") ?>

<div id="detail">
    <img src="" alt="" id="detail-backdrop">
    <div id="detail-container">

        <div id="detail-left">
            <img src="" alt="" id="detail-poster">
        </div>
        <div id="detail-right">
            <p id="detail-title"></p>
            <p id="detail-overview"></p>
            <p id="detail-release"></p>
            <p id="detail-runtime"></p>

            <div id="detail-streaming">
                <div class="detail-streaming-card-Pcontainer">
                    <h3>Rent</h3>
                    <div id="detail-streaming-rent" class="detail-streaming-card-container"></div>
                </div>

                <div class="detail-streaming-card-Pcontainer">
                    <h3>Streaming</h3>
                    <div id="detail-streaming-flatrate" class="detail-streaming-card-container"></div>
                </div>

                <div class="detail-streaming-card-Pcontainer">
                    <h3>Buy</h3>
                    <div id="detail-streaming-buy" class="detail-streaming-card-container"></div>
                </div>

                <div class="detail-streaming-card-Pcontainer">
                    <h3>Rent ;)</h3>
                    <div id="detail-streaming-rent2" class="detail-streaming-card-container"></div>
                </div>
            </div>
        </div>
    </div>

    <?php include("assets/templates/extras/recommend.php") ?>
    <?php include("assets/templates/extras/popular.php") ?>

</div>
<?php include("assets/templates/footer.php") ?>
</body>

</html>