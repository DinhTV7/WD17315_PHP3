<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            // Cú pháp: $table->kiểu dữ liệu('tên trường');
            $table->string('name', 50); // Quy định độ dài của giá trị
            $table->string('email')->unique(); // Kiểm tra các giá trị không được trùng nhau
            $table->string('phone_number', 10)->unique();
            $table->date('date_of_birth');
            $table->string('address')->nullable(); // nullable ko cần có giá trị đầu vào
            $table->tinyInteger('gender')->default(0); // default xét giá trị mặc định
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
