$(document).ready(function(){
    $('#form-update-product').submit(function (e)
    {
        e.preventDefault();
        var data = new FormData(this);
        const id = $('#id-product').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log(data);
        $.ajax({
            type: "POST",
            url: "/qladmin/product/update",
            data: data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
            },
            error: function (res)
            {
                console.log(res);
            }
        });

    })

    $('#btn-del-image').on('click', function(e)
    {
        e.preventDefault();
        console.log(123);
    })
});
