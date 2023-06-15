<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $connection = 'mysql_second';

    use HasFactory;
    public $table = "staff";
    public $fillable = [
        'id',
        'id_number',
        'location',
        'mobile_number',
        'name',
        'staff_mobile_number',
        'status',
        'created_at'
    ];

}
