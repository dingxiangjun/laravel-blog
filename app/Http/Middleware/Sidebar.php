<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Route;
class Sidebar
{
	public function handle($request, Closure $next)
	{
		$currentRouteName = Route::currentRouteName();

		view()->share([
			'currentRouteName' => $currentRouteName,
			'route' => explode('.', $currentRouteName),
		]);

		return $next($request);
	}

}
