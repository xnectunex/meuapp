<?php

session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/produto.controller.php");

if (isset($_GET) && isset($_GET['key'])) {
    $id = filter_input(INPUT_GET, 'key');
    $controller = new ProdutoController();
    $result = $controller->excluirProduto($id);

    if ($result) {
        $_SESSION['mensagem'] = "Excluido com sucesso";
        $_SESSION['sucesso'] = true;
        
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir";
        $_SESSION['sucesso'] = false;
        
    }
    header('Location:../public/produtos.php');
}