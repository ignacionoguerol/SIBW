<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 10/04/2017
 * Time: 14:52
 */
class SocialView
{
    public function out( $id )
    {
        ?>
        <nav class="social">
            <ul>
                <li><a href=# onclick="BlockAllMessageWarning('social-share')"><img class="social" src="images/face.jpg"> </a></li>
                <li><a href=# onclick="BlockAllMessageWarning('social-share')"><img class="social" src="images/twitter.jpg"> </a></li>
                <li><a href="index.php?modo=noticiaImp&id=<?php echo $id ?> "><img class="social" src="images/print.jpg"> </a></li>

            </ul>
        </nav>
        <?php
    }
}