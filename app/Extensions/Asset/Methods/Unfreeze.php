<?php
namespace App\Extensions\Asset\Methods;

use App\Extensions\Asset\Exceptions\AssetException;
use App\Models\UserAsset;
use App\Models\PlatformAsset;

// 解冻
class Unfreeze extends TradeBase
{
    // 前置操作
    public function beforeUser() {
        $this->fee = abs($this->fee);

        // 指定交易类型
        $this->type = self::TRADE_TYPE_UNFREEZE;
    }

    // 更新用户余额
    public function updateUserAsset()
    {
        $this->userAsset = UserAsset::where('user_id', $this->userId)->lockForUpdate()->first();
        if (empty($this->userAsset)) {
            throw new AssetException('用户资产不存在');
        }

        $afterFrozen = bcsub($this->userAsset->frozen, $this->fee);
        if ($afterFrozen < 0) {
            throw new AssetException('用户冻结金额不足');
        }

        $this->userAsset->balance = bcadd($this->userAsset->balance, $this->fee);
        $this->userAsset->frozen  = $afterFrozen;

        if (!$this->userAsset->save()) {
            throw new AssetException('数据更新失败');
        }

        return true;
    }

    // 更新平台资金
    public function updatePlatformAsset()
    {
        $this->platformAsset = PlatformAsset::where('id', 1)->lockForUpdate()->first();
        if (empty($this->platformAsset)) {
            throw new AssetException('平台资产不存在');
        }

        $afterFrozen = bcsub($this->platformAsset->frozen, $this->fee);
        if ($afterFrozen < 0) {
            throw new AssetException('平台冻结金额不足');
        }

        $this->platformAsset->balance = bcadd($this->platformAsset->balance, $this->fee);
        $this->platformAsset->frozen  = $afterFrozen;

        if (!$this->platformAsset->save()) {
            throw new AssetException('数据更新失败');
        }

        return true;
    }
}
