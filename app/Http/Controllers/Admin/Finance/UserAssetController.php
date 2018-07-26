<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\UserAssetRepository;

class UserAssetController extends Controller
{
    public function index(Request $request)
    {
        $userId = trim($request->user_id);

        $dataList = UserAssetRepository::getList($userId);

        return view('admin.finance.user-asset.index', compact('dataList', 'userId'));
    }
}
