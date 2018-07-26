<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\PlatformAssetRepository;

// 平台资产
class PlatformAssetController extends Controller
{
    // 实时资产
    public function index()
    {
        $platformAsset = PlatformAssetRepository::get();

        return view('admin.finance.platform-asset.index', compact('platformAsset'));
    }
}
