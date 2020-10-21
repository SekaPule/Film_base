<?php
require_once ("PDOUsing.php");

class FilmAdder extends PDOUsing
{
    private $table;
    private $directory;

    public function __construct($table){
        parent::__construct();
        $this->directory = "posters";
        $this->table = $table;
    }

    public function addPosterIntoDB($filename,$extension){
        $this->insertPDO($this->table, "`path`,`name`,`extension`", [$this->directory,$filename,$extension]);
    }

    public function addImagesIntoDir($images,$filename,$extension){
        move_uploaded_file($images['tmp_name'], $this->directory."/".$filename.".".$extension);
    }

    public function addNameOfTheFilm($name,$producer,$actor,$genre){
        $this->insertPDO($this->table,"`film_name`,`producer`,`actor`,`genre`",[$name,$producer,$actor,$genre]);
    }


}