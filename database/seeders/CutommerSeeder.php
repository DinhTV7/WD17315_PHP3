<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CutommerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Viết những câu lệnh tạo dữ liệu mẫu vào đây
        // Cú pháp: DB::table('tên bảng')->insert([bla bla]);
        DB::table('customer')->insert([
            // cú pháp: 'tên trường' => 'Giá trị',
            'name' => 'Tạ Văn Định',
            'email' => 'dinhtv7@fpt.edu.vn',
            'phone_number' => '0987654321',
            'date_of_birth' => '2004/11/20',
            'address' => 'Nam Định',
            'gender' => 1
        ]);

        // Tạo 1 bảng mới bằng migation
        // Trong bảng tạo ra 5 dữ liệu mẫu
    }
}
