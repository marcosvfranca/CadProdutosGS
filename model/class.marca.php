<?php

class marca {

    private $id;
    private $descMarca;

    function __construct($id, $descMarca = null) {
        $this->id = $id;
        $this->descMarca = $descMarca;
    }

    function getId() {
        return $this->id;
    }

    function getDescMarca() {
        return $this->descMarca;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescMarca($descMarca) {
        $this->descMarca = $descMarca;
    }

}
