<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['metodo'])) {
        switch ($_GET['metodo']) {
            case 'cadastro-produtos':
                require_once __DIR__ . '/./produto.php';
                echo json_encode(produtoController::getProdutos());
                break;
            default:
                break;
        }
    }
}