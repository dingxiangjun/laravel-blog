<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Route;
use Log;
class PermissionMiddleware
{
	public function handle($request, Closure $next, $permission)
	{
		if (Auth::guest()) {
			abort(403);
		}

		$currentRouteName = Route::currentRouteName();

		$permissions = is_array($permission) ? $permission : explode('|', $permission);

		foreach ($permissions as $permission) {
			if($currentRouteName != $permission){
				continue;
			}

			if (Auth::user()->can($permission)) {
				return $next($request);
			}else{
				continue;
			}
		}

		if (Request::ajax()) {
			return response()->ajax(0, '您未开通相应权限！');
		}

		abort(403);
	}
}
