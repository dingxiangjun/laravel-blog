<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * 用户增删改查
 */
class AdminController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$users = Admin::paginate(config('admin.page'));
		return view('admin.rbac.user.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$roles = Role::where('guard_name', 'admin')->get();
		$permissions = Permission::where('guard_name', 'admin')->get();
		$datas = [];
		if ($permissions) {
			foreach ($permissions as $v) {
				$datas[$v->group]['group_name'] = $v['group_name'];
				$datas[$v->group]['items'][] = [
					'id'   => $v->id,
					'name' => $v->name,
					'slug' => $v->slug,
				];
			}
		}
		return view('admin.rbac.user.create', compact('datas','roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'bail|required|unique:admins|max:191',
			'password' => 'bail|required|min:6',
			'email' => 'bail|required|email|unique:admins',
		]);
		try {
			$data['name'] = $request->name;
			$data['password'] = bcrypt($request->password);
			$data['email'] = $request->email;
			$admin = Admin::create($data);
			$admin->assignRole($request->roles ?? []);
			$admin->givePermissionTo($request->permissions ?? []);
			return response()->ajax(1, '添加成功');
		} catch (\Exception $e) {
			return response()->ajax(0, $e->getMessage());
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$admin = Admin::find($id);
		$roles = $admin->getRoleNames();
		$permissionss = $admin->permissions;
		$datas = [];
		if ($permissionss) {
			foreach ($permissionss as $v) {
				$datas[$v->group]['group_name'] = $v['group_name'];
				$datas[$v->group]['items'][] = [
					'id'   => $v->id,
					'name' => $v->name,
					'slug' => $v->slug,
				];
			}
		}
		return view('admin.rbac.user.show', compact('datas','admin','roles'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$admin = Admin::find($id);
		$permissionsArr = $admin->permissions->pluck('id')->toArray();
		$rolesArr = $admin->roles->pluck('id')->toArray();
		$roles = Role::where('guard_name', 'admin')->get();
		$permissions = Permission::where('guard_name', 'admin')->get();
		$datas = [];
		if ($permissions) {
			foreach ($permissions as $v) {
				$datas[$v->group]['group_name'] = $v['group_name'];
				$datas[$v->group]['items'][] = [
					'id'   => $v->id,
					'name' => $v->name,
					'slug' => $v->slug,
				];
			}
		}

		return view('admin.rbac.user.edit',compact('admin','datas','roles','permissionsArr','rolesArr'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'name' => 'bail|required|string',
			'email' => 'bail|required|email',
		]);
		try {
			$input = $request->except(['permissions','roles']);
			$admin = Admin::find($id);
			$admin->update($input);
			$admin->syncRoles($request->roles ?? []);
			$admin->syncPermissions($request->permissions ?? []);
			return response()->ajax(1, '更新成功');
		} catch (\Exception $e) {
			return response()->ajax(0, $e->getMessage());
		}
	}

	/**
	 * 删除权限
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{

	}
}
