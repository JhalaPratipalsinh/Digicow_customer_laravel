<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    public $table = "salary";
    public $fillable = [
        'id',
        'employe_id',
        'mobile_number',
        'amount',
        'date',
        'insert_from',
        'created_at'
    ];

}
