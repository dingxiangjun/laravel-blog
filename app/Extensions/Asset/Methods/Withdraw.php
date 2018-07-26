<?php
namespace App\Extensions\Asset\Methods;

use App\Extensions\Asset\Exceptions\AssetException;
use App\Models\UserAsset;
use App\Models\PlatformAsset;

// 提现
class Withdraw extends TradeBase
{
    // 前置操作
    public function beforeUser() {
        $this->fee = -abs($this->fee);

        // 指定交易类型
        $this->type = self::TRADE_TYPE_WITHDRAW;
    }

    // 更新用户余额
    public function updateUserAsset()
    {
        $this->userAsset = UserAsset::where('user_id', $this->userId)->lockForUpdate()->first();
        if (empty($this->userAsset)) {
            throw new AssetException('用户资产不存在');
        }

        $afterFrozen = bcadd($this->userAsset->frozen, $this->fee);
        if ($afterFrozen < 0) {
            throw new AssetException('用户冻结金额不足');
        }

        $this->userAsset->frozen         = $afterFrozen;
        $this->userAsset->total_withdraw = bcadd($this->userAsset->total_withdraw, abs($this->fee));

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

        $afterFrozen = bcadd($this->platformAsset->frozen, $this->fee);
        if ($afterFrozen < 0) {
            throw new AssetException('平台冻结金额不足');
        }

        $this->platformAsset->frozen         = $afterFrozen;
        $this->platformAsset->total_withdraw = bcadd($this->platformAsset->total_withdraw, abs($this->fee));

        if (!$this->platformAsset->save()) {
            throw new AssetException('数据更新失败');
        }

        return true;
    }
}
