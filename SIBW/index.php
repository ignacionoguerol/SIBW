<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <meta http-equiv="content-type" content="text/plain; charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoboScience</title>
    <link rel="icon" type="image/png" href="images/logo.png"/>
</head>
<body>
<script src="js/comments.js"></script>
<script src="js/galery.js"></script>
<script src="js/menu.js"></script>
<script src="js/liveSearch.js"></script>
    <?php
    include "Includes/IncludeFiles.php";
    include "Controller/Controller.php";

    function ques($algo)
    {
        echo "<pre>";
        var_dump($algo);
        echo "</pre>";
    }


    session_start();
    $controlador = new Controller( "localhost", "raul", "raulpsw", "Periodico");
    $controlador->init();
    $controlador->checkSession();

    if(isset($_GET["searching"])){
        $controlador->startSearch();
    }else{
        $controlador->getAccion();
        $controlador->getView();
        $controlador->viewOut();
    }

    $controlador->end();

    ?>
    <script>showDivs(0)</script>
    <script>
        active(<?php echo json_encode($controlador->getSecP())?>,<?php echo json_encode($controlador->getSecS())?>);
    </script>
</body>
</html>
