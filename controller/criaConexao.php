<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    if (isset($_POST['metodo']))
        switch ($_POST['metodo']) {
            case 'criaConexao':
                if (isset($_POST['host']) && isset($_POST['user']) && isset($_POST['password']) && isset($_POST['schema'])) {
                    if (!is_file(__DIR__ . "/../dao/class.conecta.php")) {
                        require __DIR__ . '/../dao/class.criaConexaoDao.php';
                        echo json_encode(['mensagem' => (criaConexao::criaClassConecta($_POST)) ? "Banco de dados configurado com sucesso." : "Erro ao configurar a base de dados, tente novamente."]);
                    } else {
                        echo json_encode(['mensagem' => "O arquivo de conexão já existe."]);
                    }
                } else {
                    echo json_encode(['mensagem' => "Parâmetros incompletos"]);
                }
                break;
            default:
                echo json_encode(['mensagem' => "Método não informado"]);
                break;
        }
