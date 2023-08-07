<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiLoginController extends Controller
{
    // Đăng nhập
    public function login (Request $request) {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
                'remember_me' => 'boolean'
            ]);

            // Kiểm tra xem có lỗi tính hợp lệ hay không
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'fails',
                    'mesage' => $validator->errors()->first(),
                    'errors' => $validator->errors()->toArray()
                ]);
            }

            // Kiểm tra thông tin đăng nhập nếu không đúng thì trả về thông báo
            if (!Auth::attempt(['email'=>$request->email, 'password'=> $request->password])) {
                return response()->json([
                    'status' => 'fails',
                    'mesage' => 'Đăng nhập không thành công'
                ], 401);
            }
            // Lấy ra thông tin người dùng gửi lên
            $user = $request->user();
            // dd($user);
            // Tạo 1 token cho người dùng
            $tokenResult = $user->createToken("Personal Access Token");
            $token = $tokenResult->token;
            // dd($tokenResult->accessToken);

            // Set thời gian tồn tại cho token
            $token->expires_at = Carbon::now()->addMinute(1);
            $token->save();

            // Trả về phía người dùng
            return response()->json([
                'status' => 'success',
                'access_token' => $tokenResult->accessToken,
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }
    }

    // Đăng xuất
    public function logout (Request $request) {
        // hủy bỏ token hiện tại của người dùng
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'Đăng xuất thành công'
        ]);
    }
}
