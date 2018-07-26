<?php
namespace App\Repositories\Admin;

use App\Models\PlatformAssetDaily;

class PlatformAssetDailyRepository
{
    public static function getList($dateStart, $dateEnd, $pageSize = 20)
    {
        $dataList = PlatformAssetDaily::orderBy('date', 'desc')
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
