$(document).ready(function ()
{
    getRole();
    function getRole ()
    {
        let id = $('.id-admin').val();
        $.ajax({
            type: "GET",
            url: "/qladmin/role/list".id,
            dataType: "json",
            success: function (response) {
                console.log(123);
            },
            error: function (res)
            {
                // console.log(res);
            }
        });
    }

    $('#btn-add-role').on('click', function (e)
    {
        e.preventDefault()
        $('#form-add-role').modal('show');
    })
    $('#create-role').on('click', function (e)
    {
        e.preventDefault();
        let idamd = $('.id-admin').val();
        console.log(idamd);
        let data = {
            'name': $('.name').val(),
            'admin_id': $('.id-admin').val(),
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
                console.log(response);
                $('#form-add-role').modal('hide');
                window.location = 'http://127.0.0.1:8000/qladmin/role/list'.idamd;
            },
            error: function (param)
            {
                console.log(param);
            }
        });
        console.log(data);
    })
})
