// product modifications changed
$('.available select').on('change', function() {
    var price = $(this).find('option').filter(':selected').data('price');
        base_price = $('#main-price').data('base');
        if (price) {
            $('#main-price span').text(price);
        } else {
            $('#main-price span').text(base_price);
        }
});
