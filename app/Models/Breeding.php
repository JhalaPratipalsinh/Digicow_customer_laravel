<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breeding extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $table = 'breedings';

    protected $primaryKey = 'id';

    public $fillable = [
        'sid',
        'firebase_id',
        'bull_code',
        'bull_name',
        'cost',
        'cow_id',
        'cow_name',
        'drying_date',
        'expected_date_of_birth',
        'expected_repeat_date',
        'farmer_name',
        'mobile',
        'no_straw',
        'pg_status',
        'pregnancy_date',
        'record_type',
        'repeats',
        'semen_type',
        'sex_type',
        'straw_breed',
        'strimingup_date',
        'sync_at',
        'vet_id',
        'vet_name',
        'firebase_json',
        'date_dt',
        'is_verified',
        'wallet_amount',
        'first_heat',
        'second_heat',
        'is_paid',
    ];

}
