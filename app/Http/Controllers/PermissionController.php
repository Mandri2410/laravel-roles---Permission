<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the permissions.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $permissions = Permission::paginate(10); // Adjust pagination as needed
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
            'guard_name' => 'required|string|max:255',
        ]);

        Permission::create($request->only('name', 'guard_name'));

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified permission.
     *
     * @param \Spatie\Permission\Models\Permission $permission
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param \Spatie\Permission\Models\Permission $permission
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified permission in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Spatie\Permission\Models\Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'guard_name' => 'required|string|max:255',
        ]);

        $permission->update($request->only('name', 'guard_name'));

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param \Spatie\Permission\Models\Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
