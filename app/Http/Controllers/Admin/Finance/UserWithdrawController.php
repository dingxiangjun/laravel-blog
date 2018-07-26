<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\UserWithdrawOrderRepository;
use App\Exceptions\CustomException;

class UserWithdrawController extends Controller
{
    public function index(Request $request)
    {
        $dataList = UserWithdrawOrderRepository::getList($request->no, $request->user_id, $request->status);
        $status = config('asset.withdraw.status');

        return view('admin.finance.user-withdraw.index', compact('dataList', 'status'));
    }

    // 完成
    public function complete($id)
    {
        try {
            UserWithdrawOrderRepository::complete($id);
        }
        catch(CustomException $e) {
            return response()->ajax(0, $e->getMessage());
        }

        return response()->ajax(1);
    }

    // 拒绝
    public function refuse($id)
    {
        try {
            UserWithdrawOrderRepository::refuse($id);
        }
        catch(CustomException $e) {
            return response()->ajax(0, $e->getMessage());
        }

        return response()->ajax(1);
    }
}
