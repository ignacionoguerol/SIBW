<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 12/04/2017
 * Time: 16:04
 */
class SessionView
{
    public function out()
    {
        (new HeadView())->out();
        ?>
        <div class="session">
            <?php if (isset($_SESSION["iniFail"]) && $_SESSION["iniFail"] == true) {
                echo '<p class="error">Usuario o contraseña erróneos, vuelva a intentarlo</p>';
                $_SESSION["iniFail"] = false;
            } ?>
            <form action="index.php<?php echo '?modo=' . $_SESSION["modo"] . '&id=' . $_GET["id"] . '&seccion=' . $_GET["seccion"].'&a='.$_GET["a"]."&suba=".$_GET["suba"]?>"
                  method="POST">
                <p>Usuario</p>
                <input type="text" placeholder="Nombre de usuario" name="usuario" required/>
                <p>Contraseña </p>
                <input type="password" placeholder="Contraseña" name="contraseña" required/>
                <p>
                    <a href="index.php<?php echo '?ini=true&modo=' . $_SESSION["modo"] . '&id=' . $_GET["id"] . '&seccion=' . $_GET["seccion"]
                    .'&a='.$_GET["a"]."&suba=".$_GET["suba"]?>"
                       class="btn-general">Atrás</a>
                    <input class="btn-general" type="submit" value="Iniciar Sesión"/></p>
            </form>
        </div>
        <?php
    }
}