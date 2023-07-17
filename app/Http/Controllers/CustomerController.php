<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    // Đây là nơi các bạn viết các câu lệnh thực thi
    // Cú pháp: public function ten_phương_thức () {}
    public function index ($id) {
        // Sử dụng dd(); để thực hiện việc fix lỗi
        // dd("Xin chào $name có id là $id");
        $customer = DB::table('customer')
        ->where('id', $id)->first();
        dd($customer);
    }

    // Tạo 1 phương thức có tên là hinh_chu_nhat
    // Tạo 1 router kết nối với phương thức trên 
    // ( có 2 tham số truyền vào là chieu_dai và chieu_rong )
    // Trong phương thức hinh_chu_nhat tính chu_vi và dien_tich

    public function hinh_chu_nhat ($chieu_dai, $chieu_rong) {
        $chu_vi = 2 * ($chieu_dai + $chieu_rong);
        $dien_tich = $chieu_dai * $chieu_rong;
        dd("Hình chữ nhật có chu vi : $chu_vi, diện tích là: $dien_tich");
    }

    public function customer() {
        // Cách để truy cập lấy dữ liệu từ database
        // Lấy ra toàn bộ dữ liệu trong bảng
        // $customers = DB::table('customer')->get();
        // dd($customers);

        // Lấy theo 1 số trường
        // $customers = DB::table('customer')
        //             ->select('name', 'email')->get();
        // dd($customers);

        // Lấy theo điều kiện truyền vào
        // Điều kiện đúng tuyệt đối
        // $customer = DB::table('customer')
        //     ->where('phone_number', '0987654321')->first();
        // first trả về 1 bản ghi đầu tiên tìm thấy
        // Có bao nhiêu điều kiện thì có bấy nhiêu where

        // Điều kiện gần đúng
        // $customer = DB::table('customer')
        //     ->where('name', 'like', '%Định%')->get(); // Bắt buộc phải có %
        // dd($customer);

        // Đếm số bản ghi ở trong bảng
        // $countCustomer = DB::table('customer')->count();
        // dd($countCustomer); // Tổng số bản ghi ở trong bảng

        // Xóa bản ghi theo điều kiện
        // $deleted = DB::table('customer')->where('id', 2)->delete();
        // dd($deleted); // Trả về 0/1

        // Cập nhật bản ghi theo điều kiện
        // $update = DB::table('customer')
        //     ->where('id', 3)
        //     ->update([
        //         'name' => 'Nguyễn Văn A',
        //         'gender' => 1
        //     ]);
        // dd($update);
    }

    public function listCustomer(Request $request) {
        $title = "List Customer";
        // $id = 1;
        // $name = "Nguyễn Văn A";
        // $address = "Hà Nội";
        // $email = "abc@gmail.com";
        // $phone_number = "0987654321";
        // $date_of_birth = "2004-11-20";
        // $gender = 1;

        // Tạo 1 dữ liệu cứng về customer 
        // Hiển thị sang view dưới dạng table

        // Hiển thị dữ liệu ra view blade
        // return view('customer.index', 
        // compact('title', 'id', 'name', 'address', 'email', 'phone_number', 'date_of_birth', 'gender'));
        
        // $customers = DB::table('customer')->get();
        $customers = Customer::all();

        // Khi ấn vào nút search
        if ($request->post() && $request->search_name) {
            $customers = DB::table('customer')
                ->where('name', 'like', '%'.$request->search_name.'%')->get();
        }

        return view('customer.index', compact('title', 'customers'));
    }

    // Tạo 1 route liên kết tới 1 controller có tên là add_customer
    // Từ controller tạo 1 title và render ra view có tên là add.blade.php

    public function add_customer(CustomerRequest $request) {
        $title = "Add new customer";
        if ($request->isMethod('post')) {
            // dd($request);
            // Lấy dữ liệu mà request gửi
            $params = $request->post();

            unset($params['_token']);
            // dd($params);

            // Cách thêm 1:
            // DB::table('customer')->insert($params);

            // Cách 2: Thêm dữ liệu qua model
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone_number = $request->phone_number;
            $customer->date_of_birth = $request->date_of_birth;
            $customer->gender = $request->gender;

            // Thực công việc lưu dữ liệu
            $customer->save();

            // Tạo thông báo
            if ($customer->save()) {
                Session::flash('success', 'Thêm khách hàng thành công');
                return redirect()->route('search_customer');
            } else {
                Session::flash('error', 'Lỗi thêm khách hàng');
            }
            
        }

        return view('customer.add', compact('title'));
    }

    public function edit_customer (CustomerRequest $request,$id) {
        $title = "Edit Customer";

        // Tìm kiếm thông tin chi tiết của 1 bản ghi theo id
        $detail = Customer::find($id);
        if ($request->isMethod('post')) {
            $update = Customer::where('id', $id)
            ->update($request->except('_token'));
            // except giống unset
            if ($update) {
                Session::flash('success', 'Sửa thông tin khách hàng thành công');
                return redirect()->route('search_customer');
            } else {
                Session::flash('error', 'Lỗi thêm khách hàng');
            }
        }

        return view('customer.edit', compact('title', 'detail'));
    }

    public function delete_customer($id) {
        if ($id) {
            $deleted = Customer::where('id', $id)->delete();
            if ($deleted) {
                Session::flash('success', 'Xóa thông tin khách hàng thành công');
                return redirect()->route('search_customer');
            } else {
                Session::flash('error', 'Lỗi xóa khách hàng');
            }
        }
        return;
    }
}
