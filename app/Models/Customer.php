<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // trỏ tới bảng trong CSDL mà chúng ta cần sử dụng
    protected $table = 'customer';

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone_number',
        'date_of_birth',
        'gender'
    ];
}
