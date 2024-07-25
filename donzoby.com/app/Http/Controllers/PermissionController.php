<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($from_create = false)
    {
        $permissions = [];
        foreach (Permission::get() as $permission) {
            // extract title from permission
            $title = explode(' ', $permission->name)[1] . ' management';
            // push permissions into categories
            $permissions[$title][] = $permission;
        }

        if ($from_create) {
            return $permission;
        }
        return response()->json([
            'status' => 'success',
            'data' => $permissions,
        ]);
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
        $validated = $request->validate([
            'name' => 'required|string|max:35',
        ]);
        Permission::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'permission created',
            'data' => $this->index(true),
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
        $request->merge(['id' => (int) $id]);
        $validated = $request->validate([
            'id' => 'required|exists:permissions,id',
            'name' => 'required|string|max:35',
        ]);
        Permission::find($id)->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'permission updated',
            'data' => $this->index(true),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'permission deleted',
            'data' => $this->index(true),
        ]);
        //
    }
}
