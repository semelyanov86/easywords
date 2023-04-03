<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $this->authorize('list', Permission::class);

        $search = $request->get('search', '');
        $permissions = Permission::where('name', 'like', "%{$search}%")->paginate(10);

        return view('app.permissions.index')
            ->with('permissions', $permissions)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $this->authorize('create', Permission::class);

        $roles = Role::all();

        return view('app.permissions.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        Sanctum::actingAs(request()->user(), [], 'web');

        $this->authorize('create', Permission::class);

        $data = $this->validate($request, [
            'name' => 'required|max:64',
            'roles' => 'array',
        ]);

        $permission = Permission::create($data);

        $roles = Role::find($request->roles);
        $permission->syncRoles($roles);

        return redirect()
            ->route('permissions.edit', $permission->id)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission): View
    {
        $this->authorize('view', Permission::class);

        return view('app.permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission): View
    {
        $this->authorize('update', $permission);

        $roles = Role::get();

        return view('app.permissions.edit')
            ->with('permission', $permission)
            ->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $this->authorize('update', $permission);

        $data = $this->validate($request, [
            'name' => 'required|max:40',
            'roles' => 'array',
        ]);

        $permission->update($data);

        $roles = Role::find($request->roles);
        $permission->syncRoles($roles);

        return redirect()
            ->route('permissions.edit', $permission->id)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $this->authorize('delete', $permission);

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
