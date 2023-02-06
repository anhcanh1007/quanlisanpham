@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <h5 class="card-header">Table Dark</h5>
    <div class="col-sm-3">
    <button type="button" id="btn-add-role" class="btn btn-primary">Add Role</button>
</div>
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
            <th>Admin-id</th>
            <th colspan="3">Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($acc->roles as $item )
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->admin_id }}</td>
                <td><a href="{{ url('qladmin/role/edit', [$item->id]) }}"><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td><a href="{{ url('qladmin/role/delete', [$item->id]) }}"><button type="button" class="btn btn-primary">Delete</button></a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
        <input type="hidden" id="id-admin" class="id-admin" value="{{ $acc->id }}">
    <hr>

    <div class="pagination">
    </div>
  </div>
  @push('scripts')
    {{-- <script src="{{ asset('admin/js/roles/index.js') }}"></script> --}}
  @endpush
@endsection




