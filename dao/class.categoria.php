<?php

require __DIR__ . '/./class.persistencia.php';

class categoriaDao {

    static function cadCategoria(categoria $categoria) {
        
    }

    static function altCategoria(categoria $categoria) {
        
    }

    static function delCategoria(categoria $categoria) {
        
    }

    static function buscaCategoria($where = null) {
        $sql = "SELECT * FROM `categoria` $where";
        return Persistencia::consultarBD($sql);
    }

}
