<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cow extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $table = 'cows';

    protected $primaryKey = 'id';

    protected $fillable = ['firebase_id', 'sid', 'breed_id', 'cow_breeding_1', 'cow_breeding_2', 'group_id', 'mobile_number', 'title', 'ear_code', 'date_of_birth', 'calving_lactation', 'dam', 'dam_code', 'dam_father', 'dam_father_code', 'dam_id', 'dam_mother', 'dam_mother_code', 'sire', 'sire_code', 'sire_father', 'sire_father_code', 'sire_mother', 'sire_mother_code', 'status', 'sync_at', 'firebase_json'];

    public function breed(): BelongsTo
    {
        return $this->belongsTo(CowBreed::class, 'breed_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(CowGroup::class, 'group_id', 'id');
    }


    public function getFullnameAttribute()
    {
        return $this->title.'|'.$this->id;
    }
}
