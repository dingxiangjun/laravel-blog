<?php
namespace App\Extensions\Excel;

class ExportPlatformAssetDaily extends \Maatwebsite\Excel\Files\NewExcelFile
{
    public function getFilename()
    {
        return '平台资产日报';
    }

    // 导出
    public function export($data)
    {
        $exportData = [];

        foreach ($data as $key => $value) {
            $exportData[] = [
                'date'                 => $value->getattributes()['date'],
                'amount'               => $value['amount'] + 0,
                'managed'              => $value['managed'] + 0,
                'balance'              => $value['balance'] + 0,
                'frozen'               => $value['frozen'] + 0,
                'recharge'             => $value['recharge'] + 0,
                'total_recharge'       => $value['total_recharge'] + 0,
                'withdraw'             => $value['withdraw'] + 0,
                'total_withdraw'       => $value['total_withdraw'] + 0,
                'consume'              => $value['consume'] + 0,
                'total_consume'        => $value['total_consume'] + 0,
                'refund'               => $value['refund'] + 0,
                'total_refund'         => $value['total_refund'] + 0,
                'trade_quantity'       => $value['trade_quantity'] + 0,
                'total_trade_quantity' => $value['total_trade_quantity'] + 0,
                'trade_amount'         => $value['trade_amount'] + 0,
                'total_trade_amount'   => $value['total_trade_amount'] + 0,
            ];
        }

        $result = $this->sheet('Sheet1', function ($sheet) use ($exportData) {
            $sheet->row(1, array(
                '日期',
                '平台资金',
                '平台托管',
                '用户余额',
                '用户冻结',
                '当日用户加款',
                '累计用户加款',
                '当日用户提现',
                '累计用户提现',
                '当日用户消费',
                '累计用户消费',
                '当日退款给用户',
                '累计退款给用户',
                '当日用户成交次数',
                '累计用户成交次数',
                '当日用户成交',
                '累计用户成交'
            ));
            $sheet->fromArray($exportData, null, 'A2', true, false);
        })->export('xlsx');

        return $result;
    }
}
