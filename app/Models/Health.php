<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';
    public $table = "healths";

    public $fillable = [
        'sid',
        'firebase_id',
        'cost',
        'cow_id',
        'cow_name',
        'diagnosis',
        'report',
        'diagnosis_type',
        'prognosis',
        'farmer_name',
        'health_category',
        'mobile',
        'record_type',
        'treatment',
        'treatment_date',
        'vet_id',
        'vet_name',
        'is_verified',
        'wallet_amount',
        'firebase_json',
        'is_paid',
    ];
}
