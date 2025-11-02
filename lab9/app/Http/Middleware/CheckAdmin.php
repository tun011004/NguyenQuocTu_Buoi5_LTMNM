<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user || !($user->is_admin ?? false)) {
            abort(403, 'Bạn không có quyền truy cập khu vực quản trị.');
        }
        return $next($request);
    }
}
