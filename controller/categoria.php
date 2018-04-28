<?php

require __DIR__ . '/./funcoes.php';
require __DIR__ . '/../dao/class.categoria.php';
require __DIR__ . '/../model/class.categoria.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['metodo'])) {
        $POST = array_map('addslashes', $_POST);
        switch ($_POST['metodo']) {
            case 'cad':
                if (isset($_POST['desccategoria'])) {
                    echo json_encode(["mensagem" => (categoriaDao::cadCategoria(new categoria(null, $_POST['desccategoria']))) ? "Categoria cadastrada com sucesso" : "Erro ao cadastrar categoria, tente novamente"]);
                }
                break;
            case 'alt':
                if (isset($_POST['tokencategoria']) and isset($_POST['desccategoria'])) {
                    echo json_encode(["mensagem" => (categoriaDao::altCategoria(new categoria($_POST['tokencategoria'], $_POST['desccategoria']))) ? "Categoria alterada com sucesso" : "Erro ao alterar categoria, tente novamente"]);
                }
                break;
            case 'del':
                if (isset($_POST['tokencategoria'])) {
                    echo json_encode(["mensagem" => (categoriaDao::delCategoria(new categoria($_POST['tokencategoria']))) ? "Categoria excluída com sucesso" : "Erro ao excluir categoria, tente novamente"]);
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
                $resultado = categoriaDao::buscaCategoria();
                $options = null;
                while ($linha = $resultado->fetch_assoc()) {
                    $options[md5($linha['id'])] = $linha['desccategoria'];
                }
                echo json_encode($options);
                break;
            default:
                echo json_encode(["mensagem" => "Paramêtros incompletos."]);
                break;
        }
    }
}