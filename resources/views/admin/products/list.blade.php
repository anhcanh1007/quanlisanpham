@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <h5 class="card-header">Table Dark</h5>

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
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Category</th>
            <th colspan="3">Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($pro as $item )
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->description }}</td>
                <td><img src="{{ asset('/images/'.$item->image) }}" alt="" width="50px" height="50px"></td>
                <td>{{ $item->category->name }}</td>
                <td><a href="{{ url('qladmin/product/images',[$item->id]) }}"><button type="button" class="btn btn-primary">Xem</button></a></td>
                <td><a href="{{ url('qladmin/product/edit',[$item->id]) }}"><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td><a href="{{ url('qladmin/product/delete',[$item->id]) }}"><button type="button" class="btn btn-primary">Delete</button></a></td>
            </tr>
            @endforeach
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




