<?php
global $serverPath;
define('__PATH__', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
$serverPath = __PATH__;
$param = (isset($_GET['param']) ? array_filter(explode("/", $_GET['param']), function($value) {
            return $value !== '';
        }) : ['']);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Cadastro de Produtos!</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
        <link href="<?= __PATH__ ?>css/jquery.loading.min.css" rel="stylesheet">
        <link href="<?= __PATH__ ?>css/jquery-confirm.min.css" rel="stylesheet">
        <link href="<?= __PATH__ ?>css/style.css" rel="stylesheet">
        <script>var __PATH__ = '<?= __PATH__ ?>';</script>
    </head>
    <?php
    if (!is_file(__DIR__ . "/./dao/class.conecta.php")) {
        include __DIR__ . "/./view/__criaConexao.php";
    } else {
//        include __DIR__ . './controller/segurancaUsuario.php';
        switch ($param[0]) {
            case "":
                include_once './view/__home.php';
                break;
            case "painel-controle":
                include_once './view/__home.php';
                break;
            default:
                include './view/__404.php';
                break;
        }
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= __PATH__ ?>js/jquery.mask.min.js"></script>
    <script src="<?= __PATH__ ?>js/jquery.loading.min.js"></script>
    <script src="<?= __PATH__ ?>js/jquery-confirm.min.js"></script>
    <script src="<?= __PATH__ ?>js/jquery.validate.min.js"></script>
    <script src="<?= __PATH__ ?>js/jquery.validate-additional-methods.min.js"></script>
    <?php
    if (isset($javaScript)) {
        foreach (array_map(function($value) {
            return __PATH__ . "js/$value";
        }, $javaScript) as $v) {
            echo "<script src='$v'></script>";
        }
    }
    ?>
    <script src="<?= __PATH__ ?>js/funcoes.forms.js"></script>
    <script src="<?= __PATH__ ?>js/validate.forms.js"></script>
    <script>
            var confDataTable = {
                processing: true,
                ajax: __PATH__ + "controller/pesquisas.php?metodo=<?= isset($param[1]) ? $param[1] : null ?>",
                language: {
                    lengthMenu: "Exibir _MENU_ registros por página",
                    zeroRecords: "Nada encontrado - Desculpe",
                    info: "Exibindo _PAGE_ de _PAGES_ páginas",
                    infoEmpty: "Nenhum registro disponível",
                    infoFiltered: "(Filtrado de um total de _MAX_ registros)",
                    decimal: ",",
                    emptyTable: "Sem dados disponíveis na tabela",
                    infoPostFix: "",
                    thousands: ".",
                    loadingRecords: "Carregando...",
                    processing: "Processando...",
                    search: "Pesquisar:",
                    aria: {
                        sortAscending: ": ordenar coluna em ordem crescente",
                        sortDescending: ": ordenar coluna em ordem decrescente"
                    },
                    paginate: {
                        first: "Primeira",
                        last: "Última",
                        next: "Próxima",
                        previous: "Anterior"
                    }
                }//,
//                lengthMenu: [50, 10, 25, 100]
            };
            if (typeof (extraDataTablePesq) != "undefined") {
                confDataTable = Object.assign({}, confDataTable, extraDataTablePesq);
            }
            var dataTablePesq = $(".dataTable").DataTable(confDataTable);
    </script>
</html>