<?php

require __DIR__ . '/./funcoes.php';
require __DIR__ . '/../dao/class.produto.php';
require __DIR__ . '/../model/class.produto.php';

class produtoController {

    static function getProdutos() {
        $retorno['data'] = [];
        $resultado = produtoDao::buscaProduto();
        while ($linha = $resultado->fetch_assoc()) {
            $retorno['data'][] = [
                "<div class='text-center'><img src='" . retornaUrlImagem($linha['imagem'], true) . "' class='rounded' alt='{$linha['descproduto']}' width='35' height='35'></div>",
                $linha['descproduto'],
                $linha['descmarca'],
                $linha['desccategoria'],
                "R$ " . number_format($linha['vlpreco'], 2, ',', '.'),
                "<div class='text-center'>"
                . "<div>"
                . "<button class='btn btn-sm btn-outline-primary btnAlterarProduto' data-toggle='tooltip' data-placement='top' title='Alterar' " . escreveAttrHtml($linha, 'produto') . " ><i class='fa fa-cog'></i></button>"
                . "</div>"
                . "<div>"
                . "<button class='btn btn-sm btn-outline-danger btnExcluir' data-tokenproduto='" . md5($linha['id']) . "' data-imagem='{$linha['imagem']}' data-metodo='del' data-toggle='tooltip' data-placement='top' title='Excluir'><i class='fa fa-trash'></i></button>"
                . "</div>"
                . "</div>"
            ];
        }
        return $retorno;
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['metodo'])) {
        $POST = array_map('addslashes', $_POST);
        switch ($_POST['metodo']) {
            case 'cad':
                if (isset($_POST['descproduto']) and isset($_POST['tokenmarca']) and isset($_POST['tokencategoria']) and isset($_POST['vlpreco'])) {
                    if (isset($_FILES['imagem']['name']) && $_FILES['imagem']['error'] == 0) {
                        $ano = date('Y');
                        $mes = date('m');
                        $_POST['vlpreco'] = str_replace('.', '', $_POST['vlpreco']);
                        $_POST['vlpreco'] = str_replace(',', '.', $_POST['vlpreco']);
                        $_POST['imagem'] = salvaImagem($_FILES['imagem']['tmp_name'], $_FILES['imagem']['name'], "produtos/$ano/$mes");
                        echo json_encode(["mensagem" => (produtoDao::cadProduto(
                                    new produto(null, new categoria($_POST['tokencategoria']), new marca($_POST['tokenmarca']), $_POST['descproduto'], $_POST['imagem'], $_POST['vlpreco']))) ? "Produto cadastrado com sucesso" : "Erro ao cadastrar produto, tente novamente"]);
                    }
                }
                break;
            case 'alt':
                if (isset($_POST['tokenproduto']) and isset($_POST['descproduto']) and isset($_POST['tokenmarca']) and isset($_POST['tokencategoria']) and isset($_POST['vlpreco'])) {
                    if (isset($_FILES['imagem']['name']) && $_FILES['imagem']['error'] == 0) {
                        $ano = date('Y');
                        $mes = date('m');
                        deletaImagem($_POST['altimagem']);
                        $imagem = salvaImagem($_FILES['imagem']['tmp_name'], $_FILES['imagem']['name'], "produtos/$ano/$mes");
                    } else {
                        $imagem = $_POST['altimagem'];
                    }
                    echo json_encode(["mensagem" => (produtoDao::altProduto(
                                new produto($_POST['tokenproduto'], new categoria($_POST['tokencategoria']), new marca($_POST['tokenmarca']), $_POST['descproduto'], $imagem, $_POST['vlpreco']))) ? "Produto alterado com sucesso" : "Erro ao alterar produto, tente novamente"]);
                }
                break;
            case 'del':
                if (isset($_POST['tokenproduto']) and isset($_POST['imagem'])) {
                    if (deletaImagem($_POST['imagem']))
                        echo json_encode(["mensagem" => (produtoDao::delProduto(new produto($_POST['tokenproduto']))) ? "Produto excluído com sucesso" : "Erro ao excluir produto, tente novamente"]);
                    else
                        echo json_encode(["mensagem" => "Erro ao apagar imagem do produto"]);
                }
                break;
            default:
                echo json_encode(["mensagem" => "Paramêtros incompletos."]);
                break;
        }
    }
}