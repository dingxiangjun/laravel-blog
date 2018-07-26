<?php
namespace App\Extensions\Excel;

class ExportPlatformAmountFlow extends \Maatwebsite\Excel\Files\NewExcelFile
{
    public function getFilename()
    {
        return '平台资金流水';
    }

    // 导出
    public function export($data)
    {
        $assetTradeType = config('asset.trade_type');
        $exportData = [];

        foreach ($data as $key => $value) {
            $exportData[] = [
                'id'                   => $value['id'],
                'user_id'              => $value['user_id'],
                'admin_user_id'        => $value['admin_user_id'],
                'trade_type'           => $assetTradeType['platform'][$value['trade_type']],
                'trade_subtype'        => $assetTradeType['platform_sub'][$value['trade_subtype']],
                'trade_no'             => $value['trade_no'],
                'fee'                  => $value['fee'] + 0,
                'remark'               => $value['remark'],
                'amount'               => $value['amount'] + 0,
                'managed'              => $value['managed'] + 0,
                'balance'              => $value['balance'] + 0,
                'frozen'               => $value['frozen'] + 0,
                'total_recharge'       => $value['total_recharge'] + 0,
                'total_withdraw'       => $value['total_withdraw'] + 0,
                'total_consume'        => $value['total_consume'] + 0,
                'total_refund'         => $value['total_refund'] + 0,
                'total_trade_quantity' => $value['total_trade_quantity'] + 0,
                'total_trade_amount'   => $value['total_trade_amount'] + 0,
                'created_at'           => $value['created_at'],
            ];
        }

        $result = $this->sheet('Sheet1', function ($sheet) use ($exportData) {
            $sheet->row(1, array(
                '流水号',
                '用户',
                '管理员',
                '类型',
                '子类型',
                '相关单号',
                '金额',
                '备注',
                '平台资金',
                '平台托管',
                '用户余额',
                '用户冻结',
                '累计用户加款',
                '累计用户提现',
                '累计用户消费',
                '累计退款给用户',
                '累计用户成交次数',
                '累计用户成交金额',
                '时间',
            ));
            $sheet->fromArray($exportData, null, 'A2', true, false);
        })->export('xlsx');

        return $result;
    }
}
