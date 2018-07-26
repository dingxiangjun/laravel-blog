<?php
namespace App\Repositories\Admin;

use App\Models\User;
use App\Exceptions\CustomException;
use Cache;

class UserRepository
{
	public static function getList($id, $email)
	{
		$dataList = User::orderBy('id', 'desc')
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->when($email, function ($query) use ($email) {
                return $query->where('email', $email);
            })
            ->paginate(20);

		return $dataList;
	}

    public static function find($id)
    {
        $data = User::find($id);
        if (empty($data)) {
            throw new CustomException('数据不存在');
        }

        return $data;
    }

    public static function cleanUserCache($tags = [])
    {
        $tags = $tags ?: ['home:user:rule', 'home:user:menu'];

        Cache::tags($tags)->flush();

        return true;
    }

    // 更新用户角色
    public static function updateRoles($id, $roleIds)
    {
        $model = self::find($id);

        // 更新权限
        $model->roles()->sync($roleIds);

        // 清除缓存
        self::cleanUserCache();

        return true;
    }
}
