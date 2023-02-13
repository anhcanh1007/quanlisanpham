@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <form action="{{ route('add-product') }}" method="post" id="form-add-product" enctype="multipart/form-data">
        @csrf
        <div class="" id="form-add-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
            <div class="modal-content">
                <input type="hidden" id="edit_id" >
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập tên sản phẩm</label>
                    <input type="text" class="name form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="name" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập giá sản phẩm</label>
                    <input type="number" class="price form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="price" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập mô tả</label>
                    <input type="text" class="description form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="description" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                {{-- <div id="tagsContainer">
                    <input type="text" id="tagInput" name="tag_name">
                    <button id="addTagButton">Add Tag</button>
                  </div> --}}


                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập tag</label>
                    <input type="text" class="description form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="tag_name" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nhập hình ảnh</label>
                    <input type="file" class="image form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="file_upload" required />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Thư viện ảnh</label>
                    <input type="file" class="image form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="image_gallery[]" required multiple="true" />
                    <span class="text-danger error-text title_error" id="errors"></span>
                </div>
                <div class="mb-1">
                    <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Chọn loại danh mục</label>
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
