<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    // trỏ tới bảng trong CSDL mà chúng ta cần sử dụng
    protected $table = 'customer';

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone_number',
        'date_of_birth',
        'image',
        'gender'
    ];
}
