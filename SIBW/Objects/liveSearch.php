<?php


class liveSearch
{
    private $buscando;
    private $resultado;
    private $noticias;
    private $hint;

    public function liveSearch($buscando, $noticias)
    {
        $this->noticias = $noticias;
        $this->buscando = $buscando;
        $this->hint = "";
    }

    public function start()
    {
//lookup all links from the xml file if length of q>0
        if (strlen($this->buscando) > 0) {

            for ($i = 0; $i < (count($this->noticias)); $i++) {
                $noticia = $this->noticias[$i];
                //find a link matching the search text
                if (stristr($noticia->getTitular(), $this->buscando) || stristr($noticia->getResumen(), $this->buscando)) {

?>
            <script>
                marcar(<?php echo json_encode($this->buscando)?>);
            </script>
<?php
                        $this->hint = $this->hint . "<p><a href='index.php?modo=noticiaExp&id=".$noticia->getId()."'>" . $noticia->getTitular() . "</a></p>";

                }
            }
        }


// Set output to "no suggestion" if no hint was found
// or to the correct values


        if ($this->hint == "") {
            $this->resultado = "no suggestion";
        } else {
            $this->resultado = $this->hint;
        }
        echo $this->resultado;

    }

}

?>