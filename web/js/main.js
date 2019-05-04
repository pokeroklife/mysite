function showCart(cart) {
    $('#cart-modal .modal-body').html(cart);
    $('#cart-modal').modal();
}

function getCart() {
    $.ajax({
        url: '../cart/show',
        type: 'GET',
        success: function (res) {
            if (!res) alert('ошибка');
            showCart(res);

        },


        error: function () {
            alert('Error!');
        }
    });
    return false;
}

function clearCart() {
    $.ajax({
        url: '../cart/clear',
        type: 'GET',
        success: function (res) {
            if (!res) alert('ошибка');
            showCart(res);

        },


        error: function () {
            alert('Error!');
        }
    });
}

$('#cart-modal .modal-body').on('click', '.del-item', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '../cart/del',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('ошибка');
            showCart(res);

        },


        error: function () {
            alert('Error!');
        }
    });
});

$('.cart').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '../cart/add',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('ошибка');
            showCart(res);

        },


        error: function () {
            alert('Error!');
        }
    });
});