<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission as ContractsPermission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionController extends Controller
{
 
    public function index()
{
    $permissions = ModelsPermission::latest()->paginate(20);
    return view('admin.permissions.index' , compact('permissions'));
}

    


    public function create()
    {
        return view('admin.permissions.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required'
            
        ]);

        ModelsPermission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'guard_name' => 'web'
        ]);

        alert()->success('باتشکر', 'مجوز مورد نظر ایجاد شد');
        return redirect()->route('admin.permissions.index');
    }

    public function edit(ModelsPermission $permission)
    {
        
        return view('admin.permissions.edit',compact('permission'));
    }

    public function update(Request $request, ModelsPermission $permission)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required'
            
        ]);

        $permission->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);

        alert()->success('باتشکر', 'مجوز مورد نظر ویرایش  شد');
        return redirect()->route('admin.permissions.index');
    }
}
