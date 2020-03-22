$(document).on('submit','form.delete-item-ajax', function (e) {

    e.preventDefault();

    var that = $(this),
        method = that.attr('method'),
        data = {};

    that.find('[name]').each(function () {
        var that = $(this),
            name = that.attr('name');

        data[name] = that.val();

    });

    $.ajax({
        url: '',
        type: method,
        data: data,
        async: true,
        success: function (response) {
            const cart = $("div.main-cart");
            cart.load('shopping-cart div.main-cart');
            $("div#text").load('shopping-cart div#text');
        }
    });
});
