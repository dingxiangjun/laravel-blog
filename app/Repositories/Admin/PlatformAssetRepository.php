<?php
namespace App\Repositories\Admin;

use App\Models\PlatformAsset;

class PlatformAssetRepository
{
    public static function get()
    {
        $model = PlatformAsset::find(1);

        return $model;
    }
}
