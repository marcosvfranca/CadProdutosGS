var controller = __PATH__ + "controller/produto.php";
$(function () {
    $.get(__PATH__ + "controller/marca.php?metodo=getOptions", function (data) {
        var select = $('#tokenmarca');
        $.each($.parseJSON(data), function (index, value) {
            select.append($('<option>', {
                value: index,
                text: value
            }));
        });
    });
    $.get(__PATH__ + "controller/categoria.php?metodo=getOptions", function (data) {
        var select = $('#tokencategoria');
        $.each($.parseJSON(data), function (index, value) {
            select.append($('<option>', {
                value: index,
                text: value
            }));
        });
    });
    $(document).on('click', 'button.btnAlterarProduto', function () {
        var botao = $(this);
        var form = $("<form>", {method: 'POST', role: 'form', action: __PATH__ + "controller/produto.php", class: 'formAlterar'})
                .append($("<input>", {name: 'metodo', value: 'alt', type: 'hidden'}))
                .append($("<input>", {name: 'tokenproduto', value: botao.attr('data-tokenproduto'), type: 'hidden'}))
                .append($("<input>", {name: 'altimagem', value: botao.attr('data-imagem'), type: 'hidden'}))
                .append($("<div>", {class: 'form-row'})
                        .append($("<div>", {class: 'form-group col-8'})
                                .append($("<label>", {text: 'Nome do produto'}))
                                .append($("<input>", {
                                    name: 'descproduto',
                                    value: botao.attr('data-descproduto'),
                                    type: 'text',
                                    class: 'form-control',
                                    placeholder: 'Nome do produto'
                                })))
                        .append($("<div>", {class: 'form-group col-4'})
                                .append($("<label>", {text: 'Categoria do Produto'}))
                                .append($("<select>", {
                                    name: 'tokencategoria',
                                    type: 'text',
                                    class: 'form-control'})
                                        .append(function () {
                                            var select = $(this);
                                            $.get(__PATH__ + "controller/categoria.php?metodo=getOptions", function (data) {
                                                $.each($.parseJSON(data), function (index, value) {
                                                    select.append($('<option>', {
                                                        value: index,
                                                        text: value,
                                                        selected: (index == botao.attr('data-tokencategoria')) ? true : false
                                                    }));
                                                });
                                            });
                                        })))
                        .append($("<div>", {class: 'form-group col-4'})
                                .append($("<label>", {text: 'Marca do Produto'}))
                                .append($("<select>", {
                                    name: 'tokenmarca',
                                    type: 'text',
                                    class: 'form-control'})
                                        .append(function () {
                                            var select = $(this);
                                            $.get(__PATH__ + "controller/marca.php?metodo=getOptions", function (data) {
                                                $.each($.parseJSON(data), function (index, value) {
                                                    select.append($('<option>', {
                                                        value: index,
                                                        text: value,
                                                        selected: (index == botao.attr('data-tokenmarca')) ? true : false
                                                    }));
                                                });
                                            });
                                        })))
                        .append($("<div>", {class: 'form-group col-2'})
                                .append($("<label>", {text: 'Preço do produto'}))
                                .append($("<input>", {
                                    name: 'vlpreco',
                                    value: botao.attr('data-vlpreco'),
                                    type: 'text',
                                    class: 'form-control money',
                                    placeholder: 'Preço'
                                })))
                        .append($("<div>", {class: 'form-group col-6'})
                                .append($("<label>", {text: 'Imagem do produto'}))
                                .append($("<div>", {class: 'custom-file'})
                                        .append($("<input>", {
                                            name: 'imagem',
                                            type: 'file',
                                            class: 'custom-file-input'}))
                                        .append($("<label>", {
                                            class: 'custom-file-label',
                                            text: 'Selecione a imagem caso deseje alterar a atual'})))));
        form.validate({
            rules: {
                descproduto: "required",
                vlpreco: "required"
            },
            messages: {
                descproduto: "Informe o nome do produto",
                vlpreco: "Informe o preço do produto1"
            }
        });
        showFormAlterar(form, 'Alterar produto');
    });
});