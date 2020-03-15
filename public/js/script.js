$(window).on('load', function () {

    //Ставим значения в модальное окно
    $('.edit-price').on('click', function (e) {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');

        $("#product_name").text(name);
        $("#product_price").val(price);
        $("#product_id").val(id);
    });

    //Обновляем ценник продукта
    $('#update_price').on('click', function (e) {
        var id = $('#product_id').val();
        var price = $('#product_price').val();
        $.ajax({
            method: 'POST',
            url: '/products/update',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            data: '&id=' + id + '&price=' + price,
            beforeSend: function (event) {
                $("#update_price").attr("disabled", true);
            },
            success: function (data) {
                $('#priceModal').modal('toggle');
                if (data['status'] == 'success') {
                    $('#'+id).text(price);
                    $('#btn_'+id).data('price', price);
                }
                else {
                    alert(data['message'])
                }
                $("#update_price").attr("disabled", false);
            }
        });
    });

});