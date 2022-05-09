<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::query()->where('name','!=','Super Admin')
                        ->with('permissions')->paginate(10);

        foreach ($roles as $role) {
            $permission_array = [];
            foreach ($role->permissions as $permission) {
                $permission_array[] = $permission->name;
            }
            $role->permission_array = $permission_array;
        }

        return view('admin.pages.role_permission.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array'
        ]);

        $role = Role::query()->create(['name' => $inputs['name']]);
        foreach ($inputs['permissions'] as $data) {
            $permission = Permission::query()->updateOrCreate(['name' => $data]);
            $role->givePermissionTo($permission);
        }

        return redirect()->back()->with('status','Role Created Successfully');

    }

    public function update($id,Request $request)
    {
        $inputs = $request->validate([
            'permissions' => 'required|array'
        ]);
        $all_permissions = Permission::query()->get()->pluck('name')->toArray();

        foreach ($inputs['permissions'] as $data) {
            if(!in_array($data, $all_permissions)) {
                Permission::query()->create(['name' => $data]);
            }
        }

        $role = Role::query()->find($id);
        $role->syncPermissions($inputs['permissions']);
        return redirect()->back()->with('status','Role Updated Successfully');
    }

    public function destroy($id)
    {
        Role::query()->findOrFail($id)->delete();
        return redirect()->back()->with('status','Role Deleted');
    }

    public function assignRoleIndex()
    {
        $users = User::query()->where('user_type',1)->where('email','!=','admin@app.com')->get();
        $roles = Role::query()->where('name','!=', 'Super Admin')->get();
        $users_with_roles = User::query()->whereHas('roles')->with('roles')->paginate(10);
        return view('admin.pages.role_permission.assign_role.index', compact('users','roles','users_with_roles'));
    }

    public function assignRoleStore(Request $request)
    {
        $inputs = $request->validate([
            'role' => 'required|exists:roles,id',
            'user' => 'required|exists:users,id'
        ]);

        $role = Role::query()->find($inputs['role']);
        $user = User::query()->find($inputs['user']);

        $user->assignRole($role);

        return redirect()->back()->with('status','Admin role Assigned');
    }

    public function assignRoleDestroy(User $user)
    {
        $user->removeRole($user->getRoleNames()[0]);

        return redirect()->back()->with('status','Role Revoked');
    }
}
