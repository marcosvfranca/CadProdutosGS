$(function () {
    $('main').append($('<div>', {class: 'form-row mt-4'}));
    $('#menus').find('li').find('a').each(function () {
        var x = $(this);
        $('main').find('div.form-row')
                .append($('<div>', {
                    class: 'form-group col'
                })
                        .append($('<a>', {
                            class: 'btn btn-outline-primary btn-block',
                            html: x.html(),
                            href: x.attr('href')
                        })));
    });
});