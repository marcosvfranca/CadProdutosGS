<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastro de Produtos</h1>
</div>
<form method="POST" role="form" action="<?= $GLOBALS['serverPath'] ?>controller/produto.php" id="cadProdutos" class="formCadastro" enctype="multipart/form-data">
    <input type="hidden" value="cad" name="metodo">
    <div class="form-row">
        <div class="form-group col-6">
            <label>Nome do produto</label>
            <input type="text" name="descproduto" class="form-control" placeholder="Nome do produto" autofocus>
        </div>
        <div class="form-group col-3">
            <label>Categoria</label>
            <select name="tokencategoria" id="tokencategoria" class="custom-select"></select>
        </div>
        <div class="form-group col-3">
            <label>Marca</label>
            <select name="tokenmarca" class="custom-select" id="tokenmarca"></select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-2">
            <label>Preço</label>
            <input type="text" name="vlpreco" class="form-control money" placeholder="Preço">
        </div>
        <div class="form-group col-7">
            <label>Imagem</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="imagem" id="imagem" accept="image/png">
                <label class="custom-file-label" for="imagem">Selecione a imagem</label>
            </div>
        </div>
        <div class="form-group col-3">
            <label>&nbsp;</label>
            <button class="btn btn-primary btn-block" type="submit">Cadastrar</button>
        </div>
    </div>
</form>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pesquisa de Produtos</h1>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm dataTable">
        <thead>
            <tr>
                <th></th>
                <th>Produto</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th></th>
            </tr>
        </thead>
    </table>
</div>
<?php $javaScript = ["produto.js"];?>