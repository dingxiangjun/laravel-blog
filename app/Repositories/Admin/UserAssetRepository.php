<?php
namespace App\Repositories\Admin;

use App\Models\UserAsset;

class UserAssetRepository
{
    public static function getList($userId, $pageSize = 20)
    {
        $dataList = UserAsset::orderBy('user_id', 'desc')
            ->when(!empty($userId), function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when($pageSize === 0, function ($query) {
                return $query->limit(10000)->get();
            })
            ->when($pageSize, function ($query) use ($pageSize) {
                return $query->paginate($pageSize);
            });

        return $dataList;
    }
}
