<?php
require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/produto.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/produto.controller.php");

$produto = new Produto();

if (isset($_GET) && isset($_GET['key'])) {
    $id = filter_input(INPUT_GET, 'key');
    $controller = new ProdutoController();
    $produto = $controller->buscarPorId($id);
}

?>

<div class="container">
    <?php require_once('nav.php'); ?>
    <h1>Cadastro de Produtos </h1>

    <form method="POST" action="../acoes/salvar_produto.php">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $produto->getNome() ?>">
            <input type="hidden" name="id" value="<?= $produto->getId(); ?>">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $produto->getDescricao() ?>">
        </div>
        <div class="mb-3">
            <label for="codigo_barras" class="form-label">Código de Barras</label>
            <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" value="<?= $produto->getCodigo_Barras() ?>">
        </div>
        <div class="mb-3">
            <label for="qtde_estoque" class="form-label">Quantidade de Estoque</label>
            <input type="text" class="form-control" id="qtde_estoque" name="qtde_estoque" value="<?= $produto->getQtde_Estoque() ?>">
        </div>
        <div class="mb-3">
            <label for="ativo" class="form-label">Ativo</label>
            <input type="text" class="form-control" id="ativo" name="ativo" value="<?= $produto->getAtivo() ?>">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    <?php
    if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == TRUE) {
    ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['mensagem']; ?>
        </div>
    <?php
    }
    if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == false) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['mensagem']; ?>
        </div>
    <?php
    }
    unset($_SESSION['sucesso'], $_SESSION['mensagem']);
    ?>

</div>

<?php
require_once('./footer.php');