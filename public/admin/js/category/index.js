$(document).ready(function(){

    fetchCate(1);
    function fetchCate(offset, addButton = true)
    {
        $.ajax({
            type: "GET",
            url: '/api/cate/paginate/?page=' + offset,
            dataType: "json",
            success: function (response) {
                let data = response.data;
                $('tbody').html('');

                for(let i = 1; i <= response.last_page; i++)
                {
                $('button[id^=page_]').removeClass('active');

                    if (addButton) {
                        if (i === 1) {

                        }
                        $('.pagination').append(
                            `<button class="nextbtn btn btn-primary" id="page_${i}">${i}</button>`
                        )
                    }
                    if(response.current_page == i){
                        $.each(data, function (key, item)
                        {
                            $('tbody').append(
                                `<tr>
                                    <td><p>${item.id}</p></td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>${item.name}</strong></td>
                                    <td><button type="submit" class="btn btn-primary" id="editcate-btn" value="${item.id}">Edit</button></td>
                                    <td><button type="submit" class="del-btn btn btn-primary" id="" value="${item.id}">Delete</button></td>
                            </tr>`
                            )
                        })

                    }
                }
            },
            error: function (error){
                console.log(error);
            }
        });
    }
    $(document).on('click', 'button[id^=page_]', function(e)
    {
        e.preventDefault();
        let idPage = e.target.id;
        let page = idPage.replace(/([A-Za-z]+_)([0-9]+)/g, '$2');
        fetchCate(page, false);
        $('button[id^=page_'+page+']').addClass('active');

    })

    $(document).on('click', '#add_cate', function(e){
        e.preventDefault();
        $('#form-add-cate').modal('show');
    });

    $('#create_cate').on('click', function (e)
    {
        e.preventDefault();
        var data = {
            'name': $('.name').val(),
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/api/cate/add",
            data: data,
            dataType: "json",
            success: function (response) {
                console.log(response.message);
                console.log(response.data);
                $('#form-add-cate').modal('hide');
                $('#form-add-cate').find('input').val("");
                $('#alert').text(response.message);
                fetchCate(1, false);
            },
            error: function (response) {
                let data = response.responseJSON.message;
                $('#errors').addClass('alert alert-danger');
                $('#errors').text(data);
            }
        });
    })

    $(document).on('click', '#editcate-btn', function(e){
        e.preventDefault();
        let cate_id = $(this).val();
        $('#edit_id').val(cate_id);
        $('#form-edit-cate').modal('show');
        $.ajax({
            type: "GET",
            url: "/api/cate/edit/"+cate_id,
            dataType: "json",
            success: function (response) {
                let data = response.data.name;
                $('#edit_name').val(data);
            }
        });
    });

    $(document).on('click', '#update_cate', function(e)
    {
        e.preventDefault();
        let cate_id = $('#edit_id').val();
        let data = {
            'name': $('#edit_name').val(),
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: "/api/cate/update/"+cate_id,
            data: data,
            dataType: "json",
            success: function (response) {
                $('#form-edit-cate').modal('hide');
                $('#alert').text(response.message);
                fetchCate(1, false);
            },
            error: function (response)
            {
                let data = response.responseJSON.message;
                $('#errors').addClass('alert alert-danger');
                $('span').text(data);
            }
        });
    })

    $(document).on('click', '.del-btn', function(e){
        e.preventDefault();
        let cate_id = $(this).val();
        $('#del_id').val(cate_id);
        $('#form-delete-cate').modal('show');
    });
    $(document).on('click', '#delete_cate_done', function (e) {
        e.preventDefault();
        let cate_id = $('#del_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/api/cate/delete/"+cate_id,
            success: function (response) {
                $('#form-delete-cate').modal('hide');
                $('#alert').text(response.message);
                fetchCate(1, false);
            },
            error: function (response)
            {
                console.log(response);
            }
        });
    })
});

