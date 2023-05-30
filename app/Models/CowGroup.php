<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CowGroup extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $table = 'cow_groups';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

}
