<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\PlatformAmountFlowRepository;
use App\Extensions\Excel\ExportPlatformAmountFlow;
use App\Exceptions\CustomException;

class PlatformAmountFlowController extends Controller
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

        $dataList = PlatformAmountFlowRepository::getList($userId, $tradeNo, $tradeType, $tradeSubtype, $startTime, $endTime);
        $assetTradeType = config('asset.trade_type');

        return view('admin.finance.platform-amount-flow.index', compact('dataList', 'assetTradeType'));
    }

    public function export(Request $request, ExportPlatformAmountFlow $excel)
    {
        $userId       = trim($request->user_id);
        $tradeNo      = trim($request->trade_no);
        $tradeType    = $request->trade_type;
        $tradeSubtype = $request->trade_subtype;
        $startTime    = $request->start_time;
        $endTime      = $request->end_time;
        $endTime      = !empty($endTime) ? $endTime . ' 23:59:59' : '';

        $dataList = PlatformAmountFlowRepository::getList($userId, $tradeNo, $tradeType, $tradeSubtype, $startTime, $endTime, 0);

        $maxExportRowCount = config('excel.max_export_row_count');
        if ($dataList->count() > $maxExportRowCount) {
            return back()->with(['alert' => '超过最大行数：' . $maxExportRowCount . ' 请缩小导出范围']);
        }

        $excel->export($dataList);
    }

    public function order($id)
    {
        try {
            $data = PlatformAmountFlowRepository::getOrder($id);
        } catch (CustomException $e) {
            return response()->ajax(0, $e->getMessage());
        }

        return response()->ajax(1, 'success', $data);
    }
}
