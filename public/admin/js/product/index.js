$(document).ready(function ()
{
    //show form add product
    $(document).on('click', '#add_product', function (e)
    {
        e.preventDefault();
        $('#form-add-product').modal('show');
    })

    //add product
    $('#form-add-product').submit(function(e)
    {
        e.preventDefault();
        var data = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log(data);
        $.ajax({
            type: "POST",
            url: "/api/product/add",
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                $('#form-add-product').modal('hide');
                $('#form-add-product').find('input').val("");
                $('#alert').text(response.mes)
            },
            error : function (response)
            {
                console.log(response);
            }
        });
    })
})
