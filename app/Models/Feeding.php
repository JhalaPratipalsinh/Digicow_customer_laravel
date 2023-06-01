<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeding extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    public $table = "feeding";
    public $fillable = [
        'id',
        'category',
        'cost',
        'mobile',
        'feed',
        'type',
        'insert_from',
        'quantity',
        'total',
        'date_selected',
        'units',
        'created_at'
    ];
}
