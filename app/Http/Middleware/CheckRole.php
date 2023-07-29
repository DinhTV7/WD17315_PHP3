<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra người dùng có đủ thẩm quyền hay không
        if (Auth::user()->role_id != 0) {
            Session::flash('error', 'Bạn không đủ tuổi để vào đây');
            return redirect()->route('search_customer');
        }
        return $next($request);
    }
}
