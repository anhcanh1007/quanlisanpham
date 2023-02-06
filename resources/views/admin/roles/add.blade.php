@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <h5 class="card-header">Table Dark</h5>
    <div class="col-sm-3">
</div>
    <br>
    <div>
        <h3 class="alert-success" id="alert"></h3>
    </div>

    <hr>
    {{-- start form add role --}}
    <div class="" id="form-add-role" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('create-role') }}" method="post">
                @csrf
            <div class="mb-1">
                <input type="hidden" name="admin_id" value="{{ $acc->id }}">
                <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập tên vai trò </label>
                <input type="text" id="" class="name form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="name" required />
                <span class="text-danger error-text title_error" id="errors"></span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary" id="create-role">Add </button>
            </div>
        </form>
        </div>
        </div>
    </div>
    {{-- end form add role --}}

     {{-- start form edit role --}}
     {{-- <div class="modal fade" id="form-edit-role" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="mb-1">
                <input type="hidden" id="id-admin-edit">
                <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập tên vai trò </label>
                <input type="text" id="" class="name form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="name" required />
                <span class="text-danger error-text title_error" id="errors"></span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="update-role">Add </button>
            </div>
        </div>
        </div>
    </div> --}}
    {{-- end form edit role --}}

    {{-- start delete record --}}

    {{-- end delete record --}}
    <div class="pagination">
    </div>
  </div>
  @push('scripts')
    {{-- <script src="{{ asset('admin/js/roles/index.js') }}"></script> --}}
  @endpush
@endsection




