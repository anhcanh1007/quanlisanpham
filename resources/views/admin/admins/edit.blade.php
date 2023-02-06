@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <form action="{{ route('store-account') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="" id="form-add-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập tên</label>
                    <input type="text" class="name form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="name" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập mật khẩu</label>
                    <input type="password" class="price form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="password" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập email</label>
                    <input type="text" class="description form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="email" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập hình ảnh</label>
                    <input type="file" class="image form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="file_upload" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="create_product">Add Account </button>
                </div>
            </div>
            </div>
        </div>
</form>

</div>
@push('scripts')
@endpush
@endsection
