@extends('admin.layouts.master')
@section('main')
<div class="card" >
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit product</h4>
    <div class="row">

        <div class="col-md-6">
            <form action="{{ route('update-product') }}" method="post" enctype="multipart/form-data" id="form-update-product">
                <input type="hidden" id="id-product" name="id" value="{{ $pro->id }}">
                @csrf
                <div class="card mb-4">
                    <h5 class="card-header">Sản phẩm</h5>
                        <div class="card-body">
                            <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tên sản phẩm</label>
                            <input
                                type="text"
                                class="form-control"
                                id="exampleFormControlInput1"
                                name="name"
                                value="{{ $pro->name }}"
                            />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Giá sản phẩm</label>
                                <input
                                type="number"
                                class="form-control"
                                id="exampleFormControlInput1"
                                name="price"
                                value="{{ $pro->price }}"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Mô tả</label>
                                <input
                                type="text"
                                class="form-control"
                                id="exampleFormControlInput1"
                                name="description"
                                value="{{ $pro->description }}"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                                <input
                                type="file"
                                class="form-control"
                                id="exampleFormControlInput1"
                                name="file_upload"
                                />
                                <br>
                                <img src="{{ asset('/storage/product/'.$pro->image) }}" alt="" width="100px">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Danh mục</label>
                                <select name="category_id" id="" class="form-control">
                                    @foreach ($cate as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>

        </div>
            <div class="col-md-6">
            <div class="col-md-12">
                <div class="card mb-4">
                  <h5 class="card-header">Thư viện ảnh</h5>
                    <div class="mb-3" >
                        {{-- <form action="" enctype="multipart/form-data" id="form-edit-imageGallery"> --}}
                            @foreach ($pro->images as $item)
                                <div style="display: flex;align-items: center;">
                                    <div class="col-md-3 mb-3">
                                        <img src="{{ asset('/storage/product/'.$item->name) }}" alt="" width="100px" height="100px">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="{{ route('delete-imageGallery',[$item->id]) }}"><button type="button" class="btn btn-primary" id="btn-del-image">Del</button></a>
                                    </div>
                                </div>
                            @endforeach
                        {{-- </form> --}}
                        <div class="mb-3">
                            <i style="color: blue;">Chọn thêm ảnh</i>
                            <input type="file" class="form-control" name="newImageGallery[]" multiple="true">
                        </div>
                    </div>

                </div>
            </div>


          <div class="col-md-12">
            <div class="card mb-4">
              <h5 class="card-header">Tag</h5>
              <div class="mb-3" >
                <label for="" class="form-control">Tên tag</label>
                @foreach ($pro->tags as $tag)
                <div style="display: flex;align-items: center;">
                    <div class="col-md-3 ml-10">
                        <input type="text" class="form-control" value="{{ $tag->name }}">
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('delete-tag',[$tag->id]) }}"><button type="button" class="btn btn-primary">Del</button></a>
                    </div>
                </div>
                @endforeach
                <div>
                    <i style="color: blue">Thêm Tag</i>
                    <input type="text" name="tag_name" class="form-control">
                </div>
            </div>
            </div>
            </div>
            <div>
                <button type="submit" id="update-product" class="btn btn-primary">Update</button>
            </div>
    </form>
    </div>
    </div>
</div>
</div>
@push('scripts')
    {{-- <script src="{{ asset('/admin/js/product/update.js') }}"></script> --}}
@endpush
@endsection
