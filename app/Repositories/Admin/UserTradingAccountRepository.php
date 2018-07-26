<?php
namespace App\Repositories\Admin;

use App\Models\UserTradingAccount;
use App\Exceptions\CustomException;

// 用户结算账号
class UserTradingAccountRepository
{
    public static function getList($userId, $bankCardNo)
    {
        $dataList = UserTradingAccount::orderBy('id', 'desc')
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when($bankCardNo, function ($query) use ($bankCardNo) {
                return $query->where('bank_card_no', $bankCardNo);
            })
            ->paginate(20);

        return $dataList;
    }

    public static function store($userId, $bank, $bankCardNo)
    {
        $user = UserRepository::find($userId); // 验证用户

        $model = new UserTradingAccount;
        $model->user_id      = $userId;
        $model->bank         = $bank;
        $model->bank_card_no = $bankCardNo;

        if (!$model->save()) {
            throw new CustomException('数据创建失败');
        }

        return true;
    }

    public static function destroy($id)
    {
        $model = UserTradingAccount::find($id);
        if (!$model->delete()) {
            throw new CustomException('数据删除失败');
        }

        return true;
    }
}
