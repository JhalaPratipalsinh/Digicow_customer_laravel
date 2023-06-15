<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkSales extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';
    public $table = "milk_sales";
    public $fillable = [
        'id',
        'consumer_id',
        'consumer_name',
        'consumer_type_id',
        'income',
        'insert_from',
        'milk_price',
        'milk_sales_date',
        'milk_time',
        'quantity',
        'mobile_number',
        'created_at'
    ];
}
