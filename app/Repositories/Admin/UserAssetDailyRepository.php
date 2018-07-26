<?php
namespace App\Repositories\Admin;

use App\Models\UserAssetDaily;

class UserAssetDailyRepository
{
    public static function getList($userId, $dateStart, $dateEnd, $pageSize = 20)
    {
        $dataList = UserAssetDaily::orderBy('id', 'desc')
            ->when(!empty($userId), function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!empty($dateStart), function ($query) use ($dateStart) {
                return $query->where('date', '>=', $dateStart);
            })
            ->when(!empty($dateEnd), function ($query) use ($dateEnd) {
                return $query->where('date', '<=', $dateEnd);
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
