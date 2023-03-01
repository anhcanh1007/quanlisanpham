@extends('admin.layouts.master')
@section('main')
<div class="card" >
    <h5 class="card-header">Table Dark</h5>
    <div>
        <h3 class="alert-success" id="alert"></h3>
    </div>
    <div class="table-responsive text-nowrap">
        @if (session()->has('failures'))
            <table class="table table-danger">
                <tr>
                    <th>Row</th>
                    <th>Attribute</th>
                    <th>Errors</th>
                    <th>Value</th>
                </tr>
                @foreach (session()->get('failures') as $validation)
                    <tr>
                        <td>{{ $validation->row() }}</td>
                        <td>{{ $validation->attribute() }}</td>
                        <td>
                            <ul>
                                @foreach ($validation->errors() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $validation->values()[$validation->attribute()] }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
      <table class="table table-grey">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Birthday</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($users as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->birthday }}</td>
                <td><a href=""><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td><a href=""><button type="button" class="btn btn-primary">Del</button></a></td>
            </tr>
            @endforeach
        </tbody>
        <div class="row mb-3">
            <table class="table">
                <tbody>
                    <tr>
                        <td> <a href="{{ route('export-user') }}"><button type="submit" class="btn btn-primary">Export</button></a></td>
                        <form action="{{ route('import-user') }}" method="POST" class="form-control" enctype="multipart/form-data">
                            @csrf
                            <td class="col-sm-6">
                                <input type="file" name="file" class="form-control" accept=".xlsx"  >
                            </td>
                            <td class="col-sm-6">
                                <button type="submit" class="btn btn-primary">Import</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-3">
            @if (count($errors) > 0)
            <div class="">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                    @foreach($errors->all() as $error)
                    {{ $error }} <br>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

      </table>
    </div>
    <hr>
    <div class="pagination">
        {{ $users->links() }}
    </div>
  </div>
  @push('scripts')
  @endpush
@endsection




