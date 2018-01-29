<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 09/04/2017
 * Time: 17:57
 */
class menuView // Poner aquí las secciones
{
    public function out()
    { ?>
        <nav>
            <ul>
                <li><a href="index.php?modo=portada&a=Inicio">Inicio</a></li>

                <?php
                $secciones = $_SESSION["secciones"];

                for ($i = 0; $i < count($secciones); $i++) {
                    echo '<li class="dropdown">
                            <a href="index.php?modo=seccion&a='.$secciones[$i]->getName().'&seccion=' . $secciones[$i]->getName() . '"class="dropbtn">' . $secciones[$i]->getName() . '</a>
                                <div class="dropdown-content">';
                    $subsecciones = $secciones[$i]->getSubSecciones();
                    if( count($subsecciones) > 1 )
                    for ($j = 0; $j < count($subsecciones); $j++) {
                        echo '<a href="index.php?modo=seccion&a='.$secciones[$i]->getName().
                            '&suba='.$subsecciones[$j].
                            '&seccion=' . $subsecciones[$j] . '">' . $subsecciones[$j] . '</a>';
                    }

                    echo '</div>
                        </li>';
                }

                // Se podría hacer con SESSION, pero lo hacemos mediante paso de variables por url
                $_SESSION["modo"] = $modoA = isset($_GET["modo"]) ? $_GET["modo"] : "portada";
                $_SESSION["id"] = $id = isset($_GET["id"]) ? $_GET["id"] : null;
                $_SESSION["seccion"] = $seccion = isset($_GET["seccion"]) ? $_GET["seccion"] : null;
                $seccionActiva = isset($_GET["a"]) ? $_GET["a"] : null;
                $subseccionActiva = isset($_GET["suba"]) ? $_GET["suba"] : null;
                if (!isset($_SESSION["usuario"])) {
                    ?>
                    <li><a href="index.php?modo=ini_sess&a=<?php echo $seccionActiva."&suba=".$subseccionActiva. "&id=". $id . "&modoA=" . $modoA . "&seccion=" . $seccion?> ">Iniciar
                            Sesión</a></li>
                <?php } else {
                    ?>
                    <li><a href="index.php?modo=clos_sess&a=<?php echo $seccionActiva ."&suba=".$subseccionActiva . "&id=" . $id . "&modoA=" . $modoA . "&seccion=" . $seccion?> ">Cerrar
                            Sesión</a></li>
                <?php } ?>
            </ul>

            <form class="search" action="index.php?modo=search" method="post">
                <input placeholder="Titular" name="search" onkeyup="showResult(this.value); marcar()" >
                <input id="search" type="image" src="images/search.jpg">

            </form>
            <div id="livesearch" ></div>
        </nav>

        <?php
    }
}