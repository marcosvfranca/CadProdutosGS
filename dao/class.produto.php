<?php

require __DIR__ . '/./class.persistencia.php';

class produtoDao {

    static function cadProduto(produto $produto) {
        $sql = "INSERT INTO `produto` (`idcategoria`, `idmarca`, `descproduto`, `imagem`, `vlpreco`) VALUES ("
                . "(SELECT `id` FROM `categoria` WHERE MD5(`id`) = '" . $produto->getCategoria()->getId() . "'),"
                . "(SELECT `id` FROM `marca` WHERE MD5(`id`) = '" . $produto->getMarca()->getId() . "'),"
                . "'" . $produto->getDescProduto() . "',"
                . "'" . $produto->getImagem() . "',"
                . "'" . $produto->getVlpreco() . "')";
        return Persistencia::inserirBD($sql);
    }

    static function altProduto(produto $produto) {
        $sql = "UPDATE `produto` SET "
                . "`idcategoria` = (SELECT `id` FROM `categoria` WHERE MD5(`id`) = '" . $produto->getCategoria()->getId() . "'), "
                . "`idmarca` = (SELECT `id` FROM `marca` WHERE MD5(`id`) = '" . $produto->getMarca()->getId() . "'), "
                . "`descproduto` = '" . $produto->getDescProduto() . "', "
                . "`imagem` = '" . $produto->getImagem() . "', "
                . "`vlpreco` = '" . $produto->getVlpreco() . "' "
                . "WHERE md5(`id`) = '" . $produto->getId() . "'";
        return Persistencia::alterarBD($sql);
    }

    static function delProduto(produto $produto) {
        $sql = "DELETE FROM `produto` WHERE md5(`id`) = '" . $produto->getId() . "'";
        return Persistencia::excluirBD($sql);
    }

    static function buscaProduto($where = null) {
        $sql = "   SELECT `produto`.*, `marca`.`descmarca`, `categoria`.`desccategoria` "
                . "FROM `produto` "
                . "INNER JOIN `marca` on `marca`.`id` = `produto`.`idmarca` "
                . "INNER JOIN `categoria` on `categoria`.`id` = `produto`.`idcategoria` $where";
        return Persistencia::consultarBD($sql);
    }

}
