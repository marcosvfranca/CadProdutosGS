<?php

require __DIR__ . '/./funcoes.php';
require __DIR__ . '/../dao/class.marca.php';
require __DIR__ . '/../model/class.marca.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['metodo'])) {
        $POST = array_map('addslashes', $_POST);
        switch ($_POST['metodo']) {
            case 'cad':
                if (isset($_POST['descmarca'])) {
                    echo json_encode(["mensagem" => (marcaDao::cadMarca(new marca(null, $_POST['descmarca']))) ? "Marca cadastrada com sucesso" : "Erro ao cadastrar marca, tente novamente"]);
                }
                break;
            case 'alt':
                if (isset($_POST['tokenmarca']) and isset($_POST['descmarca'])) {
                    echo json_encode(["mensagem" => (marcaDao::altMarca(new marca($_POST['tokenmarca'], $_POST['descmarca']))) ? "Marca alterada com sucesso" : "Erro ao alterar marca, tente novamente"]);
                }
                break;
            case 'del':
                if (isset($_POST['tokenmarca'])) {
                    echo json_encode(["mensagem" => (marcaDao::delMarca(new marca($_POST['tokenmarca']))) ? "Marca excluída com sucesso" : "Erro ao excluir marca, tente novamente"]);
                }
                break;
            default:
                echo json_encode(["mensagem" => "Paramêtros incompletos."]);
                break;
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['metodo'])) {
        switch ($_GET['metodo']) {
            case 'getOptions':
                $resultado = marcaDao::buscaMarca();
                $options = null;
                while ($linha = $resultado->fetch_assoc()) {
                    $options[md5($linha['id'])] = $linha['descmarca'];
                }
                echo json_encode($options);
                break;
            default:
                echo json_encode(["mensagem" => "Paramêtros incompletos."]);
                break;
        }
    }
}