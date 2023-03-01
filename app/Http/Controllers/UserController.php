<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Jobs\ProcessUser;
use Maatwebsite\Excel\Validators\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users =  User::paginate(30);
        return view('admin.users.list', compact('users'));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'listuserupdate.xlsx');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $user_import = new UsersImport();
        Excel::queueImport($user_import, $file);
        if($user_import->failures()->isNotEmpty()){
            return back()->withFailures($user_import->failures());
        }
        return redirect()->route('list-user');

    }
}
