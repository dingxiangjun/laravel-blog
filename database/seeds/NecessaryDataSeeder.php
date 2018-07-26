<?php

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\PlatformAsset;
use App\Models\HomeAuthRule;

class NecessaryDataSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Admin::create([
			'name'     => 'admin',
			'email'    => '8065806@qq.com',
			'password' => bcrypt('111111'),
		]);

		User::create([
			'name'     => 'dingxiangjun',
			'email'    => '806580688@qq.com',
			'password' => bcrypt('111111'),
		]);

		Permission::create([
			'name' =>'后台首页',
			'guard_name' =>'admin',
			'slug' =>'admin.index',
		]);


	}
}
