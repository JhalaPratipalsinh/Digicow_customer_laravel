<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkPayments extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';
    public $table = "milk_payments";
    public $fillable = [
        'id',
        'consumer_id',
        'consumer_type_id',
        'balance',
        'milk_pament_date',
        'mobile_number',
        'paid',
        'created_at'
    ];
}
