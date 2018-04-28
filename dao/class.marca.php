<?php

require __DIR__ . '/./class.persistencia.php';

class marcaDao {

    static function cadMarca(marca $produto) {
        
    }

    static function altMarca(marca $produto) {
        
    }

    static function delMarca(marca $produto) {
        
    }

    static function buscaMarca($where = null) {
        $sql = "SELECT * FROM `marca` $where";
        return Persistencia::consultarBD($sql);
    }

}
