<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\UserAddMoneyOrderRepository;
use App\Exceptions\CustomException;

// 用户加款
class UserAddMoneyController extends Controller
{
    public function index(Request $request)
    {
        $dataList = UserAddMoneyOrderRepository::getList($request->no, $request->user_id, $request->status);
        $status = config('asset.add-money.status');

        return view('admin.finance.user-add-money.index', compact('dataList', 'status'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'bail|required|integer|min:0',
            'fee'     => 'bail|required|integer|min:0',
            'remark'  => 'bail|required|string',
        ]);

        try {
            UserAddMoneyOrderRepository::store($request->user_id, $request->fee, $request->remark);
        }
        catch (CustomException $e) {
            return response()->ajax(0, $e->getMessage());
        }

        return response()->ajax(1);
    }

    // 同意
    public function agree($id)
    {
        try {
            UserAddMoneyOrderRepository::agree($id);
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
            UserAddMoneyOrderRepository::refuse($id);
        }
        catch(CustomException $e) {
            return response()->ajax(0, $e->getMessage());
        }

        return response()->ajax(1);
    }
}
