<?php

namespace App\Http\Controllers\Admin\Rbac;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * 角色增删改查
 */
class RoleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$roles = Role::where('guard_name', 'admin')->paginate(config('admin.page'));

		return view('admin.rbac.role.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
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
		return view('admin.rbac.role.create', compact('datas'));
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
			'name' => 'bail|required|unique:roles|max:191',
		]);
		try {
			$data['name'] = $request->name;
			$role = Role::create($data);
			$role->syncPermissions($request->permissions ?? []);
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
		$role = Role::where('guard_name', 'admin')->find($id);
		$permissionss = $role->permissions;
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
		return view('admin.rbac.role._permission', compact('datas','role'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$role = Role::where('guard_name', 'admin')->find($id);
		$permissionsArr = $role->permissions->pluck('id')->toArray();
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

		return view('admin.rbac.role.edit',compact('datas','role','permissionsArr'));
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
		]);
		try {
			$data['name'] = $request->name;
			$role = Role::find($id);
			$role->update($data);
			$role->syncPermissions($request->permissions ?? []);
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
