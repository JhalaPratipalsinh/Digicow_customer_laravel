<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CowBreed extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $table = 'cow_breeds';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];



}
