<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\UserAssetDailyRepository;
use App\Extensions\Excel\ExportUserAssetDaily;

class UserAssetDailyController extends Controller
{
    /**
     * @param Request $request
     * @param UserAssetDailyRepository $userAssetDailyRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $userId    = $request->user_id;
        $dateStart = $request->start_time;
        $dateEnd   = $request->end_time;

        if ($request->export == 1) {
            $userAssetDailyRepository->export($userId, $dateStart, $dateEnd);
        }

        $dataList = UserAssetDailyRepository::getList($userId, $dateStart, $dateEnd);

        return view('admin.finance.user-asset-daily.index', compact('dataList', 'userId', 'dateStart', 'dateEnd'));
    }

    public function export(Request $request, ExportUserAssetDaily $excel)
    {
        $userId    = $request->user_id;
        $dateStart = $request->start_time;
        $dateEnd   = $request->end_time;

        $dataList = UserAssetDailyRepository::getList($userId, $dateStart, $dateEnd);

        $maxExportRowCount = config('excel.max_export_row_count');
        if ($dataList->count() > $maxExportRowCount) {
            return back()->with(['alert' => '超过最大行数：' . $maxExportRowCount . ' 请缩小导出范围']);
        }

        $excel->export($dataList);
    }
}
