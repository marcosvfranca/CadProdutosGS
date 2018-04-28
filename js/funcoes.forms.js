function enviaForm(form,
        parametros = {
        acao: 'cad',
                mensagem: 'Deseja realmente salvar essas informações?',
                type: "red"
        }) {
    var formData = new FormData(form[0]);
    var reload = form.attr('data-reload');
    var notRemove = form.attr('data-not-remove');
    var botaoSubmit = form.find('button[type="submit"]');
    switch (parametros.acao) {
        case 'cad':
            $.confirm({
                title: "Informação",
                type: 'green',
                theme: 'bootstrap',
                buttons: {
                    ok: {
                        text: 'OK',
                        keys: ['o'],
                        action: function () {
                            if (reload)
                                location.reload(true);
                            else {
                                dataTablePesq.ajax.reload(null, false);
                                form[0].reset();
                                form.find('input, textarea, select').prop('disabled', false).removeClass("is-valid").removeClass("is-invalid");
                                form.find('.custom-file-input').removeClass("is-valid").next('.custom-file-label').html("Selecione a imagem");
                            }
                        }
                    }
                },
                content: function () {
                    var self = this;
                    return $.ajax({
                        url: form.attr('action'),
                        dataType: 'json',
                        method: form.attr('method'),
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            botaoSubmit.prop('disabled', true);
                        },
                        complete: function () {
                            botaoSubmit.prop('disabled', false);
                        }
                    }).done(function (response) {
                        self.setContent(response.mensagem);
                    }).fail(function (x) {
                        console.log(x);
                        self.setType('red');
                        self.setContent('Erro! Tente novamente.');
                    });
                }
            });
            break;
        default:
            $.confirm({
                title: "Atenção",
                content: parametros.mensagem,
                type: parametros.type,
                theme: 'bootstrap',
                buttons: {
                    yes: {
                        text: "Sim",
                        action: function () {
                            $.confirm({
                                title: "Informação",
                                type: 'green',
                                theme: 'bootstrap',
                                buttons: {
                                    ok: {
                                        text: 'OK',
                                        keys: ['o'],
                                        action: function () {
                                            if (!notRemove)
                                                form.remove();
                                            if (reload)
                                                location.reload(true);
                                            else
                                                dataTablePesq.ajax.reload(null, false);
                                        }
                                    }
                                },
                                content: function () {
                                    var self = this;
                                    return $.ajax({
                                        url: form.attr('action'),
                                        dataType: 'json',
                                        method: form.attr('method'),
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        beforeSend: function () {
                                            botaoSubmit.prop('disabled', true);
                                        },
                                        complete: function () {
                                            botaoSubmit.prop('disabled', false);
                                        }
                                    }).done(function (response) {
                                        self.setContent(response.mensagem);
                                    }).fail(function () {
                                        self.setType('red');
                                        self.setContent('Erro! Tente novamente.');
                                    });
                                }
                            });
                        }
                    },
                    cancel: {
                        text: "Cancelar"
                    }
                }
            });
            break;
    }
    return false;
}

function montaFormExcluir(button, parametros = {action: __PATH__ + "controller/produto.php"}) {
    var form = $("<form>", {
        method: 'POST',
        role: 'form',
        action: parametros.action,
        class: 'formExcluir',
        style: {
            display: 'none'
        }
    });
    button.each(function () {
        $.each(this.attributes, function () {
            if (this.specified) {
                if (this.name.substr(0, 5) == 'data-') {
                    form.append($("<input>", {
                        name: this.name.replace('data-', ''),
                        value: this.value,
                        type: 'hidden'
                    }));
                }
            }
        });
    });
    form.appendTo('body').submit();
}
function showFormAlterar(form, titulo, largura = 'col-10') {
    form.find('input[data-mask]').each(function () {
        $(this).mask($(this).attr('data-mask'));
    });
    $.confirm({
        columnClass: largura,
        title: titulo,
        content: form,
        theme: 'bootstrap',
        type: "blue",
        onContentReady: function () {
            form.valid();
        },
        buttons: {
            yes: {
                text: 'Alterar',
                btnClass: 'btn-primary',
                action: function () {
                    if (form.valid())
                        return form.appendTo('body').css('display', 'none').submit();
                    else
                        return false;
                }
            },
            no: {
                text: 'Cancelar'
            }
        }
    });
}

$(function () {
    $(document).on('submit', 'form.formExcluir', function () {
        return enviaForm($(this), {
            acao: 'del',
            mensagem: 'Deseja realmente excluir?'
        });
    });

    $(document).on('submit', 'form.formAlterar', function () {
        if ($(this).valid())
            return enviaForm($(this), {
                acao: 'alt',
                mensagem: 'Deseja salvar as informações?'
            });
        else
            return false;
    });

    $(document).on('submit', 'form.formCadastro', function () {
        if ($(this).valid())
            return enviaForm($(this));
        else
            return false;
    });
    var nua = navigator.userAgent;
    if ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1)) {
        $('select.form-control').removeClass('form-control').css('width', '100%');
    }
    $('[data-toggle="tooltip"]').tooltip();
    $(document).on({
        change: function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").text(fileName);
        },
        click: function () {
            $(this).removeClass("is-valid").next('.custom-file-label').addClass("selected").html("Selecione a imagem");
        }
    }, '.custom-file-input');
    $(document).on({
        click: function () {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(this).attr('data-copiar')).select();
            document.execCommand("copy");
            $temp.remove();
            $(this).attr("title", "Copiado!").tooltip("_fixTitle").tooltip("show").attr("title", "Copiar link").tooltip("_fixTitle");
        },
        mouseleave: function () {
            $(this).tooltip("hide");
        },
        mouseenter: function () {
            $(this).attr("title", "Copiar link").tooltip("show");
            $(this).attr("data-original-title", "Copiar link");
        }
    }, '.btnCopiar');
    $(document).on('focus', '.money', function () {
        $(this).mask('#.##0,00', {reverse: true});
    });
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
    $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/, optional: true
            }
        }
    });
    $('.ip_address').mask('099.099.099.099');
    $('.percent').mask('##0,00%', {reverse: true});
    $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.fallback').mask("00r00r0000", {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: "__/__/____"
        }
    });
    $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
    $(document).on('click', 'button.btnExcluir', function () {
        montaFormExcluir($(this), {action: controller});
    });
});
