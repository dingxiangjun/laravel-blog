<?php
namespace App\Extensions\Excel;

class ExportUserAssetDaily extends \Maatwebsite\Excel\Files\NewExcelFile
{
    public function getFilename()
    {
        return '用户资产日报';
    }

    // 导出
    public function export($data)
    {
        $exportData = [];

        foreach ($data as $key => $value) {
            $exportData[] = [
                'date'           => $value->getattributes()['date'],
                'user_id'        => $value['user_id'] + 0,
                'balance'        => $value['balance'] + 0,
                'frozen'         => $value['frozen'] + 0,
                'recharge'       => $value['recharge'] + 0,
                'total_recharge' => $value['total_recharge'] + 0,
                'withdraw'       => $value['withdraw'] + 0,
                'total_withdraw' => $value['total_withdraw'] + 0,
                'consume'        => $value['consume'] + 0,
                'total_consume'  => $value['total_consume'] + 0,
                'refund'         => $value['refund'] + 0,
                'total_refund'   => $value['total_refund'] + 0,
                'expend'         => $value['expend'] + 0,
                'total_expend'   => $value['total_expend'] + 0,
                'income'         => $value['income'] + 0,
                'total_income'   => $value['total_income'] + 0,
            ];
        }

        $result = $this->sheet('Sheet1', function ($sheet) use ($exportData) {
            $sheet->row(1, array(
                '日期',
                '用户ID',
                '剩余金额',
                '冻结金额',
                '当日往平台加款',
                '累计往平台加款',
                '当日从平台提现',
                '累计从平台提现',
                '当日在平台消费',
                '累计在平台消费',
                '当日从平台收到退款',
                '累计从平台收到退款',
                '当日交易支出',
                '累计交易支出',
                '当日交易收入',
                '累计交易收入',
            ));
            $sheet->fromArray($exportData, null, 'A2', true, false);
        })->export('xlsx');

        return $result;
    }
}
