<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('created_at', 'desc')->get();
        $permissions = Permission::orderBy('created_at', 'desc')->get();
        return view('admin.role')->with(['roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role_data = $request->validate([
            'name' => ['required', 'min:3', 'max:50', 'unique:roles,name'],
            'description' => ['nullable', 'min:3', 'max:255'],
            'permissions_ids' => ['required', 'exists:permissions,id'],
        ]);
        // create role
        $role = Role::create([
            'name' => $role_data['name'],
            'description' => $role_data['description'],
        ]);
        // get permissions
        $permissions = Permission::findMany($role_data['permissions_ids']);
        $role->syncPermissions($permissions);

        $role = Role::where('id', $role->id)->with('permissions')->first();

        return response()->json([
            'status' => 'success',
            'message' => 'role successfully created',
            'data' => $role,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge(['id' => $id]);
        $role_data = $request->validate([
            'id' => ['required', 'exists:roles,id',],
            'name' => ['required', 'min:3', 'max:50'],
            'description' => ['nullable', 'min:3', 'max:255'],
            'permissions_ids' => ['required', 'exists:permissions,id'],
        ]);
        // check if the new name is already taken
        $taken_role_name = Role::where('id', '!=', $id)->where('name', $role_data['name'])->first();
        if ($taken_role_name) {
            return response()->json([
                'status' => 'error',
                'message' => 'new role name already exists',
            ], 422);
        }
        // create role
        Log::info('Role ID::' . $id);
        Role::find($id)->update($role_data);
        $role = Role::find($id);
        // get permissions
        $permissions = Permission::findMany($role_data['permissions_ids']);
        $role->syncPermissions($permissions);

        $role->permissions = $permissions;

        return response()->json([
            'status' => 'success',
            'message' => 'role successfully updated',
            'data' => $role,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if ($role->name == 'super admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'super admin role cannot be deleted'
            ], 422);
        }
        $role->delete();
        return [
            'status' => 'success',
            'message' => 'role deleted',
        ];
    }
}
