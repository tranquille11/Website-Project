
$("#search").keyup(function () {
    var minLength = 3;
    var that = $(this);
    var value = $(this).val();

    if (value.length >= minLength) {
        $.ajax({
            type: "GET",
            url: '',
            data: {
                'q': value
            },
            dataType: "text",
            success: function (res) {
                if (value === $(that).val()) {
                    var result = JSON.parse(res);
                    var product = result.result[0];
                    const searchResults = $('.table-results tr').children();
                    const productImage = searchResults.children('img');

                    if (product.SKU.substring(0,3) === 'FEM') {
                        productImage.attr('src', '/bundles/website/images/female/' + product.path);
                    }
                    else if (product.SKU.substring(0,3) === 'MEN') {
                        productImage.attr('src', '/bundles/website/images/men/' + product.path);
                    }
                    else if (product.SKU.substring(0,3) === 'KDG') {
                        productImage.attr('src', '/bundles/website/images/kids/girls/' + product.path);
                    }else if (product.SKU.substring(0,3) === 'KDB') {
                        productImage.attr('src', '/bundles/website/images/kids/boys/' + product.path);
                    }

                    $('#search-results').css('display', 'block');
                    $('#item-name').text(product.name);
                    $('#item-price').text('$'+product.price);
                    $('#item-sku').text(product.SKU);
                    $('.table-results').find('a').attr('href','/admin/products/'+product.name.toLowerCase())

                }
            }
        })
    }
});

$(document).mouseup(function(e) {
    var searchRes = $('#search-results');
   if (!searchRes.is(e.target) && searchRes.has(e.target).length === 0) {
       searchRes.hide();
   }
});
