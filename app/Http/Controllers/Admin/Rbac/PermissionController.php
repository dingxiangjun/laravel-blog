<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 权限 权限增删改查
 */
class PermissionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$permissions = Permission::where('guard_name', 'admin')->latest('id')->paginate(config('admin.page'));

		return view('admin.rbac.permission.index', compact('permissions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.rbac.permission.create');
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
			'name' => 'bail|required|unique:permissions|max:255',
			'slug' => 'bail|required',
			'group' => 'bail|required',
			'group_name' => 'bail|required',
		]);
		try {
			Permission::create($request->all());
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		try {
			$permission = Permission::find($id);
			return response()->ajax(1, 'OK', $permission);
		} catch (\Exception $e) {
			return response()->ajax(0, $e->getMessage());
		}

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
			'name' => 'bail|required',
			'slug' => 'bail|required',
			'group' => 'bail|required',
			'group_name' => 'bail|required',
		]);
		try{
			$permission = Permission::find($id);
			$permission->update($request->all());
			return response()->ajax(1, 'OK');
		}catch (\Exception $e){
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
