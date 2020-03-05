
$('form.cart-ajax').on('submit', function () {

    var that = $(this),
        method = that.attr('method'),
        data = {};

    that.find('[name]').each(function() {
        var that = $(this),
            name = that.attr('name');

        data[name] = that.val();
    });

    $.ajax({
        url: '',
        type: method,
        data: data,
        async: true,
        success:function() {
            $('.fa-shopping-cart').attr('style', 'color: rgba(82, 191, 180,1)');
            $('div#text').load('shopping-cart div#text');

        }
    });

    return false;
});
