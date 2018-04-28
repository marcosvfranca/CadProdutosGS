<?php

class categoria {

    private $id;
    private $descCategoria;

    function __construct($id, $descCategoria = null) {
        $this->id = $id;
        $this->descCategoria = $descCategoria;
    }

    function getId() {
        return $this->id;
    }

    function getDescMarca() {
        return $this->descCategoria;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescMarca($descCategoria) {
        $this->descCategoria = $descCategoria;
    }

}
