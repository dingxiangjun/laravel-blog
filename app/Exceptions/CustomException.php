<?php
namespace App\Exceptions;

class CustomException extends \Exception
{
	public function errorMessage()
	{
		$errorMsg = '异常文件: ' . $this->getFile() . ' 行: ' . $this->getLine() . ' 信息: ' . $this->getMessage();

		// 写日志
		mylog('CustomError', [$errorMsg]);

		return $this->getMessage();
	}
}
