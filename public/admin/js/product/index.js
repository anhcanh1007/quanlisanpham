$(document).ready(function ()
{
    //show form add product
    $(document).on('click', '#add_product', function (e)
    {
        e.preventDefault();
        $('#form-add-product').modal('show');
    })

    //add product
    $('#create_product').on('click', function()
    {
        let data = {
            'name' : $('.name').val(),
            'price' : $('.price').val(),
            'image' : $('.image').val(),
            'description' : $('.description').val(),
            'category_id' : $('.category_id').val(),
        }
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
            dataType: "json",
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
