<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class ApiCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy ra toàn bộ thông tin khách hàng
        $customers = Customer::all();
        // Trả về danh sách khách hàng dưới dạng JSON
        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Tạo mới khách hàng
        $customer = Customer::create($request->all());

        // Trả về thông tin của khách hàng vừa thêm dưới dạng json
        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Lấy ra thông tin khách hàng tưng ứng với ID
        $customer = Customer::find($id);
        
        if ($customer) {
            // Trả về dữ liệu thông tin khách hàng dưới dạng Json
            return new CustomerResource($customer);
        } else {
            // Nếu không có thì trả về lỗi 404
            return response()->json(['message' => 'Khách hàng không tồn tại'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Lấy ra thông tin khách hàng tưng ứng với ID
        $customer = Customer::find($id);

        if ($customer) {
            // Cập nhật thông tin khách hàng
            $customer->update($request->all());
            // Trả về dữ liệu thông tin khách hàng dưới dạng Json
            return new CustomerResource($customer);
        } else {
            // Nếu không có thì trả về lỗi 404
            return response()->json(['message' => 'Khách hàng không tồn tại'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Lấy ra thông tin khách hàng tưng ứng với ID
        $customer = Customer::find($id);

        if ($customer) {
            // Nếu có thì thực hiện việc xóa thông tin
            $customer->delete();
            // Trả về dữ liệu thông tin khách hàng dưới dạng Json
            return response()->json(['message' => 'Xóa thông tin khách hàng thành công'], 200);
        } else {
            // Nếu không có thì trả về lỗi 404
            return response()->json(['message' => 'Khách hàng không tồn tại'], 404);
        }
    }
}
