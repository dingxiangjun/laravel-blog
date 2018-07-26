<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\PlatformAssetDailyRepository;
use App\Extensions\Excel\ExportPlatformAssetDaily;

class PlatformAssetDailyController extends Controller
{
    public function index(Request $request)
    {
        $dateStart = $request->start_time;
        $dateEnd   = $request->end_time;

        $dataList = PlatformAssetDailyRepository::getList($dateStart, $dateEnd);

        return view('admin.finance.platform-asset-daily.index', compact('dataList', 'dateStart', 'dateEnd'));
    }

    public function export(Request $request, ExportPlatformAssetDaily $excel)
    {
        $dateStart = $request->start_time;
        $dateEnd   = $request->end_time;

        $dataList = PlatformAssetDailyRepository::getList($dateStart, $dateEnd, 0);

        $maxExportRowCount = config('excel.max_export_row_count');
        if ($dataList->count() > $maxExportRowCount) {
            return back()->with(['alert' => '超过最大行数：' . $maxExportRowCount . ' 请缩小导出范围']);
        }

        $excel->export($dataList);
    }
}
