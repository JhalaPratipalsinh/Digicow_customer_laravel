<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkProduction extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $table = 'milk_production';

    protected $primaryKey = 'id';

    public $fillable = [
        'id',
        'cow_id',
        'cow',
        'insert_from',
        'milk_quantity',
        'milk_time_id',
        'milking_date',
        'mobile_number',
        'created_at'
    ];

}
