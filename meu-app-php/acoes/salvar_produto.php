<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/produto.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/produto.controller.php");

$produto = new Produto();

if (isset($_POST) && isset($_POST['id']) && !empty($_POST['id'])) {
    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $nome       = addslashes(filter_input(INPUT_POST, 'nome'));
    $descricao    = addslashes(filter_input(INPUT_POST, 'descricao'));
    $codigo_barras   = addslashes(filter_input(INPUT_POST, 'codigo_barras'));
    $qtde_estoque   = addslashes(filter_input(INPUT_POST, 'qtde_estoque'));
    $ativo   = addslashes(filter_input(INPUT_POST, 'ativo'));

    if (empty($nome) || empty($codigo_barras)) {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e Código de Barras";
        $_SESSION['sucesso'] = false;
        header('Location:../public/cad_produto.php?key=' . $id);
        die();
    }
    $produto->setId($id);
    $produto->setNome($nome);
    $produto->setDescricao($descricao);
    $produto->setCodigo_Barras($codigo_barras);
    $produto->setQtde_Estoque($qtde_estoque);
    $produto->setAtivo($ativo);

    $controller = new ProdutoController();
    $resultado = $controller->atualizarProduto($produto);

    if ($resultado) {
        $_SESSION['mensagem'] = "Atualizado com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_produto.php');
} else {

    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $codigo_barras = isset($_POST['codigo_barras']) ? $_POST['codigo_barras'] : null;
    $qtde_estoque = isset($_POST['qtde_estoque']) ? $_POST['qtde_estoque'] : null;
    $ativo = isset($_POST['ativo']) ? $_POST['ativo'] : null;

    if ($nome && $codigo_barras) {

        $produto->setNome($nome);
        $produto->setDescricao($descricao);
        $produto->setCodigo_Barras($codigo_barras);
        $produto->setQtde_Estoque($qtde_estoque);
        $produto->setAtivo($ativo);

        $dao = new ProdutoController();
        $resultado = $dao->criarProduto($produto);
        if ($resultado) {
            $_SESSION['mensagem'] = "Criado com sucesso";
            $_SESSION['sucesso'] = true;
        } else {
            $_SESSION['mensagem'] = "Erro ao criar";
            $_SESSION['sucesso'] = false;
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e Código de Barras";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_produto.php');
}
