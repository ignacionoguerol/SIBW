<?php
/**
 * Created by PhpStorm.
 * User: Nacho
 * Date: 13/4/17
 * Time: 10:46
 */

class RSSView{

    public function outHead($RSS){


        //output elements from "<channel>"
        echo("<p><a href='" . $RSS->getChannelLink()
            . "'>" . $RSS->getChannelTitle() . "</a>");
        echo($RSS->getChannelDescription() . "</p>");
    }

    public function printView($RSS, $i){

        echo "<h1><a href='" . $RSS->getLink($i). "'>" . $RSS->getTitle($i) . "</a></h1>";
        echo "<p>".$RSS->getDescription($i) . "</p>";

    }

}