<?php

namespace App\Providers;

use Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // 站内前端ajax返回
        Response::macro('ajax', function ($status = 1, $message = 'success', $data = []) {
            return response()->json(['status' => $status, 'message' => $message, 'data' => $data], 200, ["Content-type" => "application/json;charset=utf-8"], JSON_UNESCAPED_UNICODE);
        });

    }

	/**
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
