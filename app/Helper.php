<?php
use App\Exceptions\CustomException;

if (!function_exists('mylog')) {
    /**
     * 自定义日志写入
     * @param $fileName
     * @param array $data
     */
    function mylog($fileName, $data)
    {
        if (!is_string($fileName)) {
            throw new CustomException('文件名必须是字符串');
        }

        if (empty($data)) {
            $data = [];
        }

        $log = new \Monolog\Logger($fileName);
        $log->pushHandler(new \Monolog\Handler\StreamHandler(storage_path() . '/logs/' . $fileName . '-' . date('Y-m-d') .'.log'));

        if (is_array($data)) {
            $log->addInfo($fileName, $data);
        } else {
            $log->addInfo($fileName, [$data]);
        }
    }
}

if (!function_exists('generateOrderNo')) {
    /**
     * 生成22位订单号
     * @return string
     */
    function generateOrderNo()
    {
        // 获取今日自增变量
        $increments = \Redis::incr('increments:order:' . date('Ymd'));

        // 14位年月日 连上8位自增id
        $orderNo = date('YmdHis') . str_pad($increments, 8, 0, STR_PAD_LEFT);

        return $orderNo;
    }
}

