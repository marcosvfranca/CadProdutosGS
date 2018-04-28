<?php

include_once __DIR__ . '/./class.conecta.php';

class Persistencia {

    static function consultarBD($sql) {
        $mysqli = conectarBD::conecta();
        $sqlTratado = self::preparaSQL($sql);
        $result = $mysqli->query($sqlTratado) or die(json_encode(["sucesso" => false, "mensagem" => "Falha na execução da consulta: $sqlTratado"]));
        conectarBD::desconecta($mysqli);
        return $result;
    }

    static function inserirBD($sql) {
        $mysqli = conectarBD::conecta();
        $sqlTratado = self::preparaSQL($sql);
        $mysqli->query($sqlTratado) or die(json_encode(["sucesso" => false, "mensagem" => "Falha na execução da inserção: $sqlTratado"]));
        conectarBD::desconecta($mysqli);
        return true;
    }

    static function insereRetornandoIdBD($sql) {
        $mysqli = conectarBD::conecta();
        $sqlTratado = self::preparaSQL($sql);
        $mysqli->query($sqlTratado) or die(json_encode(["sucesso" => false, "mensagem" => "Falha na execução da inserção: $sqlTratado"]));
        $id = mysqli_insert_id($mysqli);
        conectarBD::desconecta($mysqli);
        return $id;
    }

    static function alterarBD($sql) {
        $mysqli = conectarBD::conecta();
        $sqlTratado = self::preparaSQL($sql);
        $mysqli->query($sqlTratado) or die(json_encode(["sucesso" => false, "mensagem" => "Falha na execução da alteração: $sqlTratado"]));
        conectarBD::desconecta($mysqli);
        return true;
    }

    static function excluirBD($sql) {
        $mysqli = conectarBD::conecta();
        $sqlTratado = self::preparaSQL($sql);
        $mysqli->query($sqlTratado) or die(json_encode(["sucesso" => false, "mensagem" => "Falha na execução da exclusão: $sqlTratado"]));
        conectarBD::desconecta($mysqli);
        return true;
    }

    static function preparaSQL($sql) {
        $s = str_ireplace("'NULL'", "NULL", $sql);
        return $s;
    }

    static function retornaConexaoBD() {
        return conectarBD::conecta();
    }

    static function executaQueryComConexao($con, $sql, $fechaConexao = false) {
        $result = $con->query(self::preparaSQL($sql)) or die(json_encode(["sucesso" => false, "mensagem" => "Falha na execução do sql: $sql"]));
        if ($fechaConexao)
            conectarBD::desconecta($con);
        return $result;
    }

    static function fechaConexao($con) {
        conectarBD::desconecta($con);
        return true;
    }

}
