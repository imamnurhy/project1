<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Datatables;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('master.role');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required'
        ]);

        $input = $request->all();
        Role::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data role berhasil tersimpan.'
        ]);
    }

    public function edit($id)
    {
        return Role::find($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
            'guard_name' => 'required'
        ]);

        $input = $request->all();
        $role = Role::findOrFail($id);
        $role->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Data role berhasil diperbaharui.'
        ]);
    }
    
    public function destroy($id)
    {
        Role::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Data role berhasil dihapus.'
        ]);
    }

    public function api()
    {
        $role = Role::all();
        
        return Datatables::of($role)
            ->addColumn('permissions', function($p){
                return count($p->permissions)." <a href='".route('role.permissions', $p->id)."' class='text-success pull-right' title='Edit Permissions'><i class='icon-clipboard-list2 mr-1'></i></a>";
            })
            ->addColumn('action', function($p){
                return "
                    <a href='#' onclick='edit(".$p->id.")' title='Edit Role'><i class='icon-pencil mr-1'></i></a>
                    <a href='#' onclick='remove(".$p->id.")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->rawColumns(['action', 'permissions'])
            ->toJson();
    }

        //--- Permission
    public function permissions($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('master._permission.form', compact('role', 'permissions'));
    }

    public function getPermissions($id)
    {
        $role = Role::findOrFail($id);
        return $role->permissions;
    }

    public function storePermissions(Request $request)
    {
        $request->validate([
            'permissions' => 'required'
        ]);

        $role = Role::findOrFail($request->id);
        $role->givePermissionTo($request->permissions);

        return response()->json([
            'success' => true,
            'message' => 'Data permission berhasil tersimpan.'
        ]);
    }

    public function destroyPermission(Request $request, $name)
    {
        $role = Role::findOrFail($request->id);
        $role->revokePermissionTo($name);
    }
}
