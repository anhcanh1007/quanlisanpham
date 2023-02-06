$(document).ready(function(){

    //show tag
    showTag(1);
    function showTag (offset, addButton = true)
    {
        $.ajax({
            type: "GET",
            url: "/api/tag/list/?page="+ offset,
            dataType: "json",
            success: function (response) {
                let data = response.data;
                $('tbody').html('');
                for(let i = 1; i <= response.last_page; i++)
                {
                    $('button[id=page_]').removeClass('active');
                    if(addButton) {
                        $('.pagination').append(
                            `<button class="nextbtn btn btn-primary" id="page_${i}">${i}</button>`
                        )
                    }
                    if(response.current_page == i)
                    {
                        $.each(data, function (key, item)
                        {
                            $('tbody').append(
                                `<tr>
                                    <td><p>${item.id}</p></td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>${item.name}</strong></td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>${item.color}</strong></td>
                                    <td><button type="submit" class="edit-tag-btn btn btn-primary" id="" value="${item.id}">Edit</button></td>
                                    <td><button type="submit" class="del-btn btn btn-primary" id="" value="${item.id}">Delete</button></td>
                            </tr>`
                            )
                        })
                    }
                }
            },
            error: function (response)
            {
                console.log(response);
            }
        });
    }

    $(document).on('click', 'button[id^=page_]', function(e)
    {
        e.preventDefault();
        let idPage = e.target.id;
        let page = idPage.replace(/([A-Za-z]+_)([0-9]+)/g, '$2');
        showTag(page, false);
        $('button[id^=page_'+page+']').addClass('active');

    })

    //show form add tag
    $(document).on('click', '#add_tag', function (e)
    {
        e.preventDefault();
        $('#form-tag-add').find('input').val('');
        $('#form-add-tag').modal('show');
    })

    //add tag
    $(document).on('click', '#create_tag', function (e)
    {
        e.preventDefault();
        let data = {
            'name' : $('.name').val(),
            'color' : $('.color').val(),
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/api/tag/add",
            data: data,
            dataType: "json",
            success: function (response) {
                $('#form-add-tag').modal('hide');
                $('#form-add-tag').find('input').val('');
                $('#alert').text(response.message);
                showTag(1, false);
            },
            error : function (response)
            {
                let data = response.responseJSON.errors;
                $('#errors').addClass('alert alert-danger');
                $.each(data, function (key, value) {
                    $('i.' +key+ '_error').text(value[0]);
                });
            }
        });
    })

    //show form delete
    $(document).on('click', '.del-btn', function (e)
    {
        e.preventDefault();
        let id = $(this).val();
        $('#del_id').val(id);
        $('#form-delete-cate').modal('show');
    })

    $('#delete_tag_done').on('click', function (e)
    {
        e.preventDefault();
        let id = $('#del_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/api/tag/delete/"+id,
            success: function (response) {
                $('#form-delete-cate').modal('hide');
                $('#alert').text(response.message);
                showTag(1, false);
            },
            error: function (response)
            {
                console.log(response);
            }
        });
    })

    $(document).on('click', '.edit-tag-btn', function (e)
    {
        e.preventDefault();
        let id = $(this).val();
        $('#edit_id').val(id);
        $('#form-edit-tag').modal('show');
        $.ajax({
            type: "GET",
            url: "/api/tag/edit/"+id,
            dataType: "json",
            success: function (response) {
                let data = response.data;
                $('.name').val(data.name);
                $('.color').val(data.color);
            },
            error: function (response)
            {
                console.log(response);
            }
        });
    })

    $(document).on('click', '#update_tag', function (e)
    {
        e.preventDefault();
        let id = $('#edit_id').val();
        let data = {
            'name': $('#edit_name').val(),
            'color': $('#edit_color').val(),
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: "/api/tag/update/"+id,
            data: data,
            dataType: "json",
            success: function (response) {
                $('#form-add-cate').find('input').val("");
                $('#form-edit-tag').modal('hide');
                $('#alert').text(response.message);
                showTag(1, false);
            },
            error: function (response)
            {
                console.log(response);
                let data = response.responseJSON.errors;
                $('#errors').addClass('alert alert-danger');
                $.each(data, function (key, value) {
                    $('span.' +key+ '_error').text(value[0]);
                });
            }
        });
    })
});
