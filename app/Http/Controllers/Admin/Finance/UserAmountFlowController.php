<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\UserAmountFlowRepository;

class UserAmountFlowController extends Controller
{
    public function index(Request $request)
    {
        $userId       = trim($request->user_id);
        $tradeNo      = trim($request->trade_no);
        $tradeType    = $request->trade_type;
        $tradeSubtype = $request->trade_subtype;
        $startTime    = $request->start_time;
        $endTime      = $request->end_time;
        $endTime      = !empty($endTime) ? $endTime . ' 23:59:59' : '';

        $dataList = UserAmountFlowRepository::getList($userId, $tradeNo, $tradeType, $tradeSubtype, $startTime, $endTime);
        $assetTradeType = config('asset.trade_type');

        return view('admin.finance.user-amount-flow.index', compact('dataList', 'assetTradeType'));
    }
}
