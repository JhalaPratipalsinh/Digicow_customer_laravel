<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldCow extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $table = 'sold_cow';

    protected $primaryKey = 'id';

    public $fillable = [
        "id",
        "cow_id",
        "cow_category",
        "cow_name",
        "phone_number",
        "amount",
        "buyer_name",
        "sales_date",
        "created_at",
        "updated_at",
        "deleted_at"
    ];
}
