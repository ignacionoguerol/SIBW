<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/administrator.css">
    <meta http-equiv="content-type" content="text/plain; charset=" UTF-8
    ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoboScience</title>
    <link rel="icon" type="image/png" href="images/logo.png"/>
</head>
<body>
<script src="../js/menu.js"></script>

<?php
include "../Includes/IncludeFilesGest.php";
include "../Controller/ControllerGest.php";

        $controlador = new ControllerGest( "localhost", "raul", "raulpsw", "Periodico");
        $controlador->init();
        $controlador->checkSession();

        $controlador->getAccion();
$controlador->getView();
        $controlador->end();

function ques($algo)
{
    echo "<pre>";
    var_dump($algo);
    echo "</pre>";
}

?>
<script>
    activeMenuGest(<?php echo json_encode( $controlador->getMenuActivo() )?>);
</script>
</body>
</html>
