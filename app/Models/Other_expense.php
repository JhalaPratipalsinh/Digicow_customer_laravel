<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other_expense extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    public $table = "other_expenses";
    public $fillable = [
        'id',
        'name',
        'mobile',
        'amount',
        'date_selected',
        'created_at'
    ];
}
