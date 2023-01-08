@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <h5 class="card-header">Table Dark</h5>
    <div class="form-group">
      <button type="button" class="btn btn-primary">Search</button>
      <button type="button" id="add_cate" class="btn btn-primary">Add category</button>
      <br>
    </div>
    <br>
    <div>
        <h3 class="alert-success" id="alert"></h3>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-dark">
        <thead>
          <tr>
            <th>#</th>
            <th>Category Name</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        </tbody>
      </table>
    </div>
    <hr>
    {{-- start form add cate --}}
    <div class="modal fade" id="form-add-cate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="edit_id" >
            <div class="mb-1">
                <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập tên danh mục</label>
                <input type="text" class="name form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="name" required />
                <span class="text-danger error-text title_error" id="errors"></span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="create_cate">Add Category </button>
            </div>
        </div>
        </div>
    </div>
    {{-- end form add cate --}}

     {{-- start form edit cate --}}
     <div class="modal fade" id="form-edit-cate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="edit_id">
            <div class="mb-1">
                <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập tên danh mục</label>
                <input type="text" id="edit_name" class="name form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="name" required />
                <span class="text-danger error-text title_error" id="errors"></span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="update_cate">Update </button>
            </div>
        </div>
        </div>
    </div>
    {{-- end form edit cate --}}

    {{-- start delete record --}}
    <div class="modal fade" id="form-delete-cate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="del_id" >
            <div class="mb-1">
                <h3 class="alert-danger">Bạn có chắc chắn muốn xóa không?</h3>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="delete_cate_done">OK</button>
            </div>
        </div>
        </div>
    </div>
    {{-- end delete record --}}
    <div class="pagination">
    </div>
  </div>
@endsection




