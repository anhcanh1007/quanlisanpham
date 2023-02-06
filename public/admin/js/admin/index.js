$(document).ready(function()
{
    $('#btn-add-role').on('click', function (e)
    {
        e.preventDefault();
        let id = $('#btn-add-role').val();
        $('#form-add-role').modal('show');
        $('#id-admin').val(id);
    })

    $('#create-role').on('click', function (e)
    {
        e.preventDefault();
        let id =   $('#id-admin').val();
        console.log(id);
        let data = {
            'name': $('.name').val(),
            'admin_id' : id,
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/qladmin/role/add",
            data: data,
            dataType: "json",
            success: function (response) {
                $('#form-add-role').modal('hide');
                console.log(response);
            },
            error: function (res)
            {
                console.log(res);
            }
        });
    })

    $('#form-edit-role').on('click', function (e)
    {
        e.preventDefault();

    })
});
