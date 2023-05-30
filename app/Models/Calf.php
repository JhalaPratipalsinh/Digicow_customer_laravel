<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calf extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $table = 'calves';

    protected $primaryKey = 'id';

    public $fillable = [
        'id', //autoincrement
        'sid',
        'breed_id' , //string
        "cow_breeding_1",
        "cow_breeding_2",
        'calf_code', // string
        'calf_name', // string
        'calf_weight', // string
        'created_at', // datetime
        'd_o_b', // datetime
        'dam', //string nullable
        'dam_code', //string nullable
        'dam_father', // string nullable
        'dam_father_code', //string nullable
        'dam_id', //string nullable
        'dam_mother', //string nullable
        'dam_mother_code', //string nullable
        'expected_mature_date' , //datetime nullable
        'mobile_number', //string
        'sex', // string
        'sire' ,//string nullable
        'sire_code',//string nullable
        'sire_father',//string nullable
        'sire_father_code',//string nullable
        'sire_mother',//string nullable
        'sire_mother_code',//string nullable
        'status', //string
        'sync_at', // string
        'firebase_json'
    ];

    public function breed(): BelongsTo
    {
        return $this->belongsTo(CowBreed::class, 'breed_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(CowGroup::class, 'group_id', 'id');
    }

}
