<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require "templates/header.php" ?>
    <img src="images/night_skyline.jpg" alt="" id="big_img">
    <div id="projects">
        <div class="project_pf">
            <img src="images/p1_image.png" alt="">
            <p>
                Project 1 was about how we made our first website and uploaded it to a server named thor.
                In this project I showed off a navbar, images, importing youtube videos, a footer, and more.
                This project I made for a special person who wanted a site made for a baby sitting website.
                This project was wrote in HTML and CSS.
            </p>
            <a href="classProjects/p1/index.php">Project 1</a>
        </div>
        <div class="project_pf">
            <img src="images/p2_image.png" alt="">
            <p>
                Project 2 was about how we can use javascript to have some useful features. Some cool features that
                we did was a calculator, a button where you cant click it and more. This project was wrote using HTML, CSS, and javascript. I learned how much different
                javascript can be from a cool language like Java.
            </p>
            <a href="classProjects/p2/index.php">Project 2</a>

        </div>
        <div class="project_pf">
            <video src="images/p3_video.mp4" autoplay muted loop></video>
            <p>
                Project 3 was about how you can use a backend language like PHP. PHP can be used to make repeatable
                html, used to determine html based on condisitons, and so much more. This project was based around
                space-x. It shows off a login system, changing html randomly, and rock paper scissors
            </p>
            <a href="classProjects/p3/index.php">Project 3</a>

        </div>
        <div class="project_pf">
            <img src="images/p4_image.png" alt="">
            <p>
                Project 3 was about how you can use a backend language like PHP. PHP can be used to make repeatable
                html, used to determine html based on condisitons, and so much more. This project was based around
                space-x. It shows off a login system, changing html randomly, and rock paper scissors
            </p>
            <a href="classProjects/p4/index.php">Project 4</a>

        </div>
    </div>
    <?php require "templates/footer.php" ?>
</body>

</html>