<!--
Robert Sutton
10.18.24
This Page is for Calculator
-->

<?php require("templates/p2Header.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calc</title>
    <script src="scripts/calc.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="calc">
        <div>
            <input type="number" name="" id="num1" value="0">
        </div>

        <div id="number_2_div">
            <input type="number" name="" id="num2" value="0">
        </div>
        <div id="opo">
            <button onclick='math("+")'>Add</button>
            <button onclick='math("-")'>Subtract</button>
            <button onclick='math("*")'>Multiply</button>
            <button onclick='math("/")'>Division</button>
            <button onclick='math("sqr")'>Square Root</button>
            <button onclick='math("^")'>Exponent</button>
        </div>
        <div>
            <input type="text" value="0" id="answer">
        </div>

    </div>
    <div id="history">

    </div>
</body>

</html>