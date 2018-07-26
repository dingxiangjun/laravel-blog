<?php
namespace App\Repositories\Admin;

use App\Models\PlatformAmountFlow;
use App\Exceptions\CustomException;
use DB;

class PlatformAmountFlowRepository
{
    public static function getList($userId, $tradeNo, $tradeType, $tradeSubtype, $timeStart, $timeEnd, $pageSize = 20)
    {
        $dataList = PlatformAmountFlow::orderBy('id', 'desc')
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

    public static function find($id)
    {
        $data = PlatformAmountFlow::find($id);
        if (empty($data)) {
            throw new CustomException('该流水记录不存在');
        }

        return $data;
    }

    // 获取流水订单信息
    public static function getOrder($id)
    {
        $data = self::find($id)->flowable;
        if (empty($data)) {
            throw new CustomException('未找到该流水的订单记录');
        }

        $tableColumn = DB::table('INFORMATION_SCHEMA.COLUMNS')
            ->select('COLUMN_NAME', 'COLUMN_COMMENT')
            ->where('table_name', $data->getTable())
            ->pluck('COLUMN_COMMENT', 'COLUMN_NAME');

        $dataArr = $data->toArray();

        // 构造返回的数据结构
        $result = [];
        foreach ($dataArr as $key => $value) {
            switch ($key) {
                case 'created_at':
                    $column = '创建时间';
                    break;
                case 'updated_at':
                    $column = '修改时间';
                    break;
                default:
                    $column = $tableColumn[$key] ?: $key;
                    break;
            }

            $result[] = [
                'column' => $column,
                'value'  => $value,
            ];
        }

        return $result;
    }
}
