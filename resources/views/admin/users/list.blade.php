@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <h5 class="card-header">Table Dark</h5>
    <div class="form-group">
      <button type="button" class="btn btn-primary">Search</button>
      <button type="button" id="add_tag" class="btn btn-primary">Add Tag</button>
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
            <th>Name</th>
            <th>Color</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        </tbody>
      </table>
    </div>
    <hr>
    {{-- start form add tag --}}
    <div class="modal fade" id="form-add-tag" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="mb-1">
                <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập tên tag</label>
                <input type="text" class="name form-control"  name="name" />
                <br>
                <i class="text-danger error-text name_error" id="errors"></i>
            </div>
            <div class="mb-1">
                <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập màu tag</label>
                <input type="text" class="color form-control"  name="name" />
                <i class="text-danger error-text color_error" id="errors"></i>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="create_tag">Add Tag </button>
            </div>
        </div>
        </div>
    </div>
    {{-- end form add tag --}}

     {{-- start form edit tag --}}
     <div class="modal fade" id="form-edit-tag" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="edit_id">
            <div class="mb-1">
                <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập tên tag</label>
                <input type="text" class="name form-control" id="edit_name"  aria-label="Name" aria-describedby="basic-addon-name" name="name" required />
                <span class="text-danger error-text name_error" id="errors"></span>
            </div>
            <div class="mb-1">
                <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập màu tag</label>
                <input type="text" class="color form-control" id="edit_color"  aria-label="Name" aria-describedby="basic-addon-name" name="name" required />
                <span class="text-danger error-text color_error" id="errors"></span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="update_tag">Update </button>
            </div>
        </div>
        </div>
    </div>
    {{-- end form edit tag --}}

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
            <button type="submit" class="btn btn-primary" id="delete_tag_done">OK</button>
            </div>
        </div>
        </div>
    </div>
    {{-- end delete record --}}
    <div class="pagination">
    </div>
  </div>
  @push('scripts')
    <script src="{{ asset('admin/js/user/index.js') }}"></script>
  @endpush
@endsection




