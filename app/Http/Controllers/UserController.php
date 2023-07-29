<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // Đăng nhập
    public function login(UserRequest $request) {
        if ($request->isMethod('POST')) {
            // Sử dụng thằng Auth::attempt kiểm tra thông tin đăng nhập
            if (Auth::attempt(['email'=>$request->email, 'password'=> $request->password])) {
                return redirect()->route('search_customer');
            } else {
                Session::flash('error', 'Sai thông tin đăng nhập');
                return redirect()->route('login');
            }
        }
        return view('auth.login');
    }

    // Đăng ký
    public function register(UserRequest $request) {
        if ($request->isMethod('POST')) {
            // Lấy toàn bộ dữ liệu trong form đăng ký mà chúng ta gửi lên
            $params = $request->except("_token");
            // Mã hóa mật khẩu người dùng cung cấp
            $params["password"] = Hash::make($request->password);
            // Đặt giá trị email_verified_at là thời gian hiện tại
            $params["email_verified_at"] = Carbon::now('Asia/Ho_Chi_Minh');
            $user = User::create($params);

            if ($user->id) {
                Session::flash('success', 'Thêm tài khoản thành công');
                return redirect()->route('login');
            }
        }
        return view('auth.register');
    }

    // Đăng xuất
    public function logout () {
        Auth::logout();
        return redirect()->route('login');
    }
}
