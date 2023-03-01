@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Add product</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('add-product') }}" method="post" enctype="multipart/form-data" id="form-update-product">
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
                                    value="{{ old('name') }}"
                                />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Giá sản phẩm</label>
                                    <input
                                    type="number"
                                    class="form-control"
                                    id="exampleFormControlInput1"
                                    name="price"
                                    value="{{ old('price') }}"
                                    />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Mô tả</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="exampleFormControlInput1"
                                    name="description"
                                    value="{{ old('description') }}"
                                    />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                                    <input
                                    type="file"
                                    class="form-control"
                                    id="exampleFormControlInput1"
                                    name="file_upload"
                                    value="{{ old('file_upload') }}"
                                    />
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
                      <div class="card-body">
                        <div class="mb-3" >
                            <label for="" class="form-label">Chọn nhiều ảnh</label>
                            <div class="mb-3">
                                <input type="file" class="form-control" name="image_gallery[]" multiple="true">
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
              <div class="col-md-12">
                <div class="card mb-4">
                  <h5 class="card-header">Tag</h5>
                  <div class="card-body">
                    <div class="mb-3" >
                        <label for="" class="form-label">Tên tag</label>
                        <input type="text" name="tag_name" class="form-control" value="{{ old('tag_name') }}">
                    </div>
                  </div>
                </div>
               </div>
                <div>
                    <button type="submit" id="update-product" class="btn btn-primary">Add</button>
                </div>
        </form>
        </div>
        </div>
    </div>
</div>

@push('scripts')
{{-- <script src="{{ asset('/admin/js/product/index.js') }}"></script> --}}
@endpush
@endsection

@section('scripts')
<script>
    const tagsContainer = document.getElementById('tagsContainer');
    const tagInput = document.getElementById('tagInput');
    const addTagButton = document.getElementById('addTagButton');

    addTagButton.addEventListener('click', function() {
      const tags = tagInput.value.split(',');
      console.log(tags);
      if (!tags) return;

    //   tags.forEach(function(tag) {
    //     const tagElement = document.createElement('span');
    //     tagElement.innerHTML = tag;
    //     tagElement.classList.add('tag');

    //     tagsContainer.appendChild(tagElement);
    //   });

      tagInput.value = '';
    });
  </script>
@endsection
