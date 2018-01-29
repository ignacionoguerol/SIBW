<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 12/05/2017
 * Time: 18:47
 */
class GestSessionView
{
    public function out()
    {
        //(new HeadView())->out();
        ?>
        <div class="session">
            <form action="../administrator/index.php" method="POST">
                <p>Usuario</p>
                <input type="text" placeholder="Nombre de usuario" name="usuario" required/>
                <p>Contraseña </p>
                <input type="password" placeholder="Contraseña" name="contraseña" required/>
                <p>
                    <a href="index.php<?php echo '?ini=true'?>"
                       class="btn-general">Atrás</a>
                    <input class="btn-general" type="submit" value="Iniciar Sesión"/></p>
            </form>
        </div>
        <?php
    }
}