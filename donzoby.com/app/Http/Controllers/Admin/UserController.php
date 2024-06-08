<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        $roles = Role::with('permissions')->orderBy('created_at', 'desc')->get();
        return view("admin.users", compact("users", "roles"));
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
        //
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
        $validated = $request->validate([
            'role_id' => ['nullable', 'numeric', 'exists:roles,id',],
            'user_id' => ['required', 'numeric', 'exists:users,id',],
        ]);

        $role_array = $validated['role_id'] ? [(Role::find($validated['role_id'])->name)] : [];
        $user = User::find($validated['user_id']);
        $user->syncRoles($role_array);
        $user->roles;

        return response()->json([
            'status' => 'success',
            'message' => 'user role successfully updated',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
