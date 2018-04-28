$(function () {
    $('#criaConexao').validate({
        rules: {
            host: "required",
            user: "required",
            password_again: {
                equalTo: '#password'
            },
            schema: "required"
        },
        messages: {
            host: "Informe o host do BD",
            user: "Informe o usuário do banco de dados",
            password_again: {
                equalTo: "As senhas devem ser iguais"
            },
            schema: "Informe o nome do banco de dados"
        }
    });
    $('#cadProdutos').validate({
        rules: {
            descproduto: "required",
            vlpreco: "required",
            imagem: "required"
        },
        messages: {
            descproduto: "Preencha o nome do produto",
            vlpreco: "Preencha o valor do produto",
            imagem: "Selecione a imagem do produto"
        }
    });
});