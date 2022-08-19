$(document).ready(function () {
    window._token = $('meta[name="csrf-token"]').attr('content')

})
var cartUpdateTimeOut = null;

function getCartItemCount() {
    $.ajax({
        headers: {'x-csrf-token': _token},
        method: 'POST',
        url: "/cart/item-count",
    })
        .done(function (data) {
            $("#cart_item_count").html("( "+data+" )");
        })
        .fail(function (err) {
            if (err.status == 401) {
                location.href = "/login"
            } else {
                //hata mesajı
            }
        })

}

function addToCart(product_id) {
    $.ajax({
        headers: {'x-csrf-token': _token},
        method: 'POST',
        url: "/cart/add",
        data: {product_id: product_id,}
    })
        .done(function () {
            //mesaj
        })
        .fail(function (err) {
            if (err.status == 401) {
                location.href = "/login"
            } else {
                //hata mesajı
            }
        })
        .always(function (){
            location.reload()
        })
}

function removeFromCart(product_id) {
    $.ajax({
        headers: {'x-csrf-token': _token},
        method: 'POST',
        url: "/cart/remove",
        data: {product_id: product_id,}
    })
        .done(function () {
            //mesaj
        })
        .fail(function (err) {
            if (err.status == 401) {
                location.href = "/login"
            } else {
                //hata mesajı
            }
        })
        .always(function (){
            location.reload()
        })
}

function updateCart(product_id, quantity) {
    clearTimeout(cartUpdateTimeOut);
    cartUpdateTimeOut = setTimeout(function (){
        $.ajax({
            headers: {'x-csrf-token': _token},
            method: 'POST',
            url: "/cart/update",
            data: {product_id: product_id, quantity: quantity}
        })
            .done(function () {
                //mesaj
            })
            .fail(function (err) {
                if (err.status == 401) {
                    location.href = "/login"
                } else {
                    //hata mesajı
                }
            })
            .always(function (){
                location.reload()
            })
    },1000)
}

function truncateCart() {
    alert("");
}
