<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 12/05/2017
 * Time: 19:19
 */
class MenuGestView
{
    public function out()
    { ?>
        <nav id="menu">
            <ul>
                <li class="ab"><a href="../administrator/index.php?modo=gestNoticias&active=Noticias">Noticias</a></li>
                <?php
                if (isset($_SESSION["editor"])) {
                    ?>
                    <li class="ab"><a href="../administrator/index.php?modo=gestComentariosNoticia&active=Comentarios">Comentarios</a>
                    </li>
                    <li class="ab"><a
                                href="../administrator/index.php?modo=gestSecciones&active=Secciones">Secciones</a></li>
                    <li class="ab"><a
                                href="../administrator/index.php?modo=gestPublicidad&active=Publicidad">Publicidad</a>
                    </li>
                    <li class="ab"><a href="../administrator/index.php?modo=gestPortada&active=Portada">Portada</a></li>
                <?php } ?>
                <?php
                if (isset($_SESSION["usuarioGest"])) {
                    ?>
                    <li><a href="index.php?modo=close_sess">Cerrar Sesion</a></li>
                <?php } ?>
            </ul>

            <?php /*<form class="search" action="../administrator/index.php?modo=search" method="post">
                <input placeholder="Titular" name="search">
                <input id="search" type="image" src="../images/search.jpg">
            </form> */
            ?>
        </nav>

        <?php
    }
}