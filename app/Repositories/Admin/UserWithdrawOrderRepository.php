<?php
namespace App\Repositories\Admin;

use App\Models\UserWithdrawOrder;
use App\Exceptions\CustomException;
use DB;
use Asset;
use Auth;

class UserWithdrawOrderRepository
{
    public static function getList($no, $userId, $status)
    {
        $dataList = UserWithdrawOrder::orderBy('id', 'desc')
            ->when($no, function ($query) use ($no) {
                return $query->where('no', $no);
            })
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->paginate(20);

        return $dataList;
    }

    public static function find($id)
    {
        $model = UserWithdrawOrder::lockForUpdate()->find($id);
        if (empty($model)) {
            throw new CustomException('数据不存在');
        }

        return $model;
    }

    // 完成提现
    public static function complete($id)
    {
        DB::beginTransaction();

        $model = self::find($id);
        if ($model->status != 1) {
            throw new CustomException('状态不正确');
        }

        $model->status = 2;
        if (!$model->save()) {
            DB::rollback();
            throw new CustomException('操作失败');
        }

        // 解冻
        Asset::withdraw($model->fee, 2, $model->no, '提现成功', $model->user_id, Auth::user()->id, $model);

        DB::commit();
        return true;
    }

    // 拒绝提现
    public static function refuse($id)
    {
        DB::beginTransaction();

        $model = self::find($id);
        if ($model->status != 1) {
            throw new CustomException('状态不正确');
        }

        $model->status = 3;
        if (!$model->save()) {
            DB::rollback();
            throw new CustomException('操作失败');
        }

        // 解冻
        Asset::unfreeze($model->fee, 4, $model->no, '拒绝提现', $model->user_id, Auth::user()->id, $model); // 解冻

        DB::commit();
        return true;
    }
}
