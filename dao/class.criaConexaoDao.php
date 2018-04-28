<?php

class criaConexao {

    static function criaClassConecta($post) {
        $dados = array_map('addslashes', $post);
        $conteudo = "<?php\n"
                . "\n"
                . "class conectarBD {\n"
                . "    private static \$host = \"{$dados['host']}\";\n"
                . "    private static \$username = \"{$dados['user']}\";\n"
                . "    private static \$passwd = \"{$dados['password']}\";\n"
                . "    private static \$dbname = \"{$dados['schema']}\";\n"
                . "\n"
                . "    static function conecta() {\n"
                . "        \$mysqli = new mysqli(self::\$host, self::\$username, self::\$passwd, self::\$dbname);\n"
                . "        if (mysqli_connect_errno()) {\n"
                . "            sleep(2);\n"
                . "            return self::conecta();\n"
                . "        } else {\n"
                . "            \$mysqli->set_charset(\"utf8\");\n"
                . "            \$mysqli->query(\"SET NAMES 'utf8'\");\n"
                . "            \$mysqli->query('SET character_set_connection=utf8');\n"
                . "            \$mysqli->query('SET character_set_client=utf8');\n"
                . "            \$mysqli->query('SET character_set_results=utf8');\n"
                . "            \$mysqli->query(\"SET lc_time_names = 'pt_BR'\");\n"
                . "            return \$mysqli;\n"
                . "        }\n"
                . "    }\n"
                . "\n"
                . "    static function desconecta(\$mysqli) {\n"
                . "        \$mysqli->close();\n"
                . "    }\n"
                . "\n"
                . "}\n";
        $fp = fopen(__DIR__ . "/./class.conecta.php", "a");
        fwrite($fp, $conteudo);
        fclose($fp);
        require_once __DIR__ . '/./class.persistencia.php';
        $con = Persistencia::retornaConexaoBD();

        Persistencia::executaQueryComConexao($con, "DROP TABLE IF EXISTS `produto`");
        Persistencia::executaQueryComConexao($con, "DROP TABLE IF EXISTS `marca`");
        Persistencia::executaQueryComConexao($con, "DROP TABLE IF EXISTS `categoria`");

        Persistencia::executaQueryComConexao($con, "CREATE TABLE `marca` ("
                . "`id` INT NOT NULL AUTO_INCREMENT,"
                . "`descmarca` VARCHAR(155) NOT NULL,"
                . "PRIMARY KEY (`id`))");
        Persistencia::executaQueryComConexao($con, "CREATE TABLE `categoria` ("
                . "`id` INT NOT NULL AUTO_INCREMENT,"
                . "`desccategoria` VARCHAR(155) NOT NULL,"
                . "PRIMARY KEY (`id`))");
        Persistencia::executaQueryComConexao($con, "CREATE TABLE `produto` ("
                . "`id` INT NOT NULL AUTO_INCREMENT,"
                . "`idcategoria` INT NOT NULL,"
                . "`idmarca` INT NOT NULL,"
                . "`descproduto` VARCHAR(174) NOT NULL,"
                . "`imagem` VARCHAR(500) NULL,"
                . "`vlpreco` DECIMAL(15,2) NULL,"
                . "PRIMARY KEY (`id`),"
                . "INDEX `fk_idmarca_produto_idx` (`idmarca` ASC),"
                . "INDEX `fk_idcategoria_produto_idx` (`idcategoria` ASC),"
                . "CONSTRAINT `fk_idmarca_produto `"
                . "FOREIGN KEY (`idmarca`) "
                . "REFERENCES `marca` (`id`) "
                . "ON DELETE RESTRICT "
                . "ON UPDATE CASCADE,"
                . "CONSTRAINT `fk_idcategoria_produto` "
                . "FOREIGN KEY (`idcategoria`) "
                . "REFERENCES `categoria` (`id`) "
                . "ON DELETE RESTRICT "
                . "ON UPDATE CASCADE)");

        Persistencia::executaQueryComConexao($con, "INSERT INTO `marca` (`descmarca`) VALUES ('GERAL')");
        Persistencia::executaQueryComConexao($con, "INSERT INTO `categoria` (`desccategoria`) VALUES ('GERAL')", true);
        return true;
    }

}
