<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerClients extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';
    public $table = "tbl_farmer_clients";

    public $fillable = [
        'id',
        'name',
        'location',
        'client_mobile',
        'farmer_mobile',
        'status',
        'user_type',
        'created_at'
    ];


}
