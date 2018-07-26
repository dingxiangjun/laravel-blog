<?php
namespace App\Repositories\Admin;

use App\Models\UserAmountFlow;

class UserAmountFlowRepository
{
    public static function getList($userId, $tradeNo, $tradeType, $tradeSubtype, $timeStart, $timeEnd, $pageSize = 20)
    {
        $dataList = UserAmountFlow::orderBy('id', 'desc')
            ->when(!empty($userId), function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!empty($tradeNo), function ($query) use ($tradeNo) {
                return $query->where('trade_no', $tradeNo);
            })
            ->when(!empty($tradeType), function ($query) use ($tradeType) {
                return $query->where('trade_type', $tradeType);
            })
            ->when(!empty($tradeSubtype), function ($query) use ($tradeSubtype) {
                return $query->where('trade_subtype', $tradeSubtype);
            })
            ->when(!empty($timeStart), function ($query) use ($timeStart) {
                return $query->where('created_at', '>=', $timeStart);
            })
            ->when(!empty($timeEnd), function ($query) use ($timeEnd) {
                return $query->where('created_at', '<=', $timeEnd);
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
