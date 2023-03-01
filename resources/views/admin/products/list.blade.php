@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <h5 class="card-header">Table Dark</h5>
    <br>
    <div>
        <h3 class="alert-success" id="alert"></h3>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <td>Tag</td>
            <th>Category</th>
            <th colspan="3">Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($pro as $item )
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ number_format($item->price) }} $</td>
                <td>{{ $item->description }}</td>
                <td><img src="{{ asset('/storage/product/'.$item->image) }}" alt="" width="50px" height="50px"></td>
                <td>
                @foreach ($item->tags as $tag)
                <li>{{ $tag->name }}</li>
                @endforeach
                </td>
                <td>{{ $item->category->name }}</td>
                <td><a href="{{ route('see-image-gallery',[$item->id]) }}"><button type="button" class="btn btn-primary">Xem</button></a></td>
                <td><a href="{{ route('edit-product',[$item->id]) }}"><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td><a href="{{ route('delete-product',[$item->id]) }}"><button type="button" class="btn btn-primary">Delete</button></a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <hr>
    <div class="row">
        {{-- <div class="col-md-12">
            <div class="text-center">
                {{ $pro->render('admin.paginate.index') }}
            </div>
        </div> --}}
        {{ $pro->links() }}
    </div>
  </div>
  @push('scripts')
  @endpush
@endsection




