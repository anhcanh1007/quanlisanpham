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
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th colspan="3">Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($account as $item )
            <tr>
                <input type="hidden" value="{{ $item->id }}" id="id-admin">
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td><img src="{{ asset('/images/account/'.$item->image) }}" alt="" width="50px" height="50px"></td>
                <td><a href="{{ url('qladmin/account/edit',[$item->id]) }}"><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td><a href="{{ url('qladmin/account/delete',[$item->id]) }}"><button type="button" class="btn btn-primary">Delete</button></a></td>
                <td><a href="{{ url('qladmin/role/add',[$item->id]) }}"><button type="button" value="{{ $item->id }}" class="btn btn-primary" id="">Add Role</button></a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <hr>
    <div class="pagination">
    </div>
  </div>
  @push('scripts')
  @endpush
@endsection




