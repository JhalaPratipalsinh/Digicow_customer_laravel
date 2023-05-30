<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeadCow extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $table = 'dead_cow';

    public $fillable = [
        "id",
        "cow_id",
        "cow_category",
        "cow_name",
        "mobile_number",
        "cause_of_death",
        "carcass_amount",
        "death_date",
        "created_at",
        "updated_at",
        "deleted_at"
    ];
    protected $primaryKey = 'id';

    public function cow(): BelongsTo
    {
        return $this->belongsTo(Cow::class, 'cow_id', 'id');
    }

}
