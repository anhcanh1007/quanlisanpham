@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <div>
        <h3 class="alert-success" id="alert"></h3>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-white">
        <thead>
          <tr>
            <th>#</th>
            <th>Main Image</th>
            <th colspan="3">Image Gallery</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <tr>
                <td>{{ $product->id }}</td>
                <td><img src="{{ asset('/storage/product/'.$product->image) }}" alt="" width="100" height="100"></td>
                @foreach ($product->images as $item )
                    <td><img src="{{ asset('/storage/product/'.$item->name) }}" alt="" width="100" height="100"></td>
                @endforeach
            </tr>
        </tbody>
      </table>
    </div>
    <hr>
    {{-- start form add product --}}

    {{-- end form add product --}}

     {{-- start form edit cate --}}

    {{-- end form edit cate --}}

    {{-- start delete record --}}

    {{-- end delete record --}}
    <div class="pagination">
    </div>
  </div>
  @push('scripts')
  @endpush
@endsection




