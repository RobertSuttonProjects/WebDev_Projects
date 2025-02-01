<?php 
$itemID = isset($_GET['id']) ? $_GET['id'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/scripts/movie.js"></script>
    <script>
            const itemID = <?php echo $itemID ?>;
            const type = "movie";
            if(itemID != null){
                loadDetails(itemID, type)
            }
    </script>

    <link rel="stylesheet" href="assets/styles/ai.css">

</head>

<body>
    <div id="detail-container">
        <img src="" alt="" id="detail-backdrop">
        <div id="detail-left">
            <img src="" alt="" id="detail-poster">
            <p id="detail-release"></p>
            <p id="detail-runtime"></p>
            <div id="detail-popular"></div>
        </div>
        <div id="detail-right">
            <p id="detail-title"></p>
            <p id="detail-overview"></p>
        </div>
        <div id="detail-recommended"></div>
    </div>
</body>

</html>