<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function create($id)
    {
        $acc = Admin::find($id);
        return view('admin.roles.add', compact('acc'));
    }

    public function store(Request $request)
    {
        if (Role::create($request->all())) {
            return redirect()->route('role-list', [$request->admin_id]);
        }
    }

    public function index($id)
    {
        // $account = Role::with('admin')->where('roles.admin_id', $id)->get();
        $acc = Admin::with('roles')->where('id', $id)->first();
        // dd($acc);
        return view('admin.roles.list', compact('acc'));
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('role-list', [$role->admin_id]);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->update($request->all());
        return redirect()->route('role-list', [$request->admin_id]);
    }
}
