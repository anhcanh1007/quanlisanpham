<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminAcountController extends Controller
{
    public function index()
    {
        return view('admin.admins.add');
    }
    public function store(Request $request)
    {
        if ($request->has('file_upload')) {
            $file = $request->file_upload;
            $name_image = $file->getClientoriginalName();
            $file->move(public_path('images/account'), $name_image);
        }
        $admin = new Admin();
        $admin->name = $request['name'];
        $admin->password = $request['password'];
        $admin->email = $request['email'];
        $admin->image = $name_image;
        $admin->save();
        return redirect()->route('list-account');
    }
    public function getAccount()
    {
        $account = Admin::with('roles')->get();
        return view('admin.admins.list', compact('account'));
        // return response()->json(['account' => $account]);
    }
    public function destroy($id)
    {
        $acc = Admin::find($id);
        $acc->delete();
        return redirect()->route('list-account');
    }
}
