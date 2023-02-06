@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <form action="{{ url('qladmin/product/update',[$pro->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="" id="form-add-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
            <div class="modal-content">
                <input type="hidden" id="edit_id" >
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập tên sản phẩm</label>
                    <input type="text" class="name form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="name" value="{{ $pro->name }}" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập giá sản phẩm</label>
                    <input type="number" class="price form-control" value="{{ $pro->price }}"  aria-label="Name" aria-describedby="basic-addon-name" name="price" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập mô tả</label>
                    <input type="text" class="description form-control" value="{{ $pro->description }}"  aria-label="Name" aria-describedby="basic-addon-name" name="description" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập hình ảnh</label>
                    <input type="file" class="image form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="file_upload" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder"  for="basic-addon-name">Chọn loại danh mục</label>
                    <select class="category_id form-control" name="category_id">
                        @foreach ($cate as $item )
                            <option value="{{ $item->id }}" class="form-control">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="create_product">Add Product </button>
                </div>
            </div>
            </div>
        </div>
</form>

</div>
@push('scripts')
@endpush
@endsection
