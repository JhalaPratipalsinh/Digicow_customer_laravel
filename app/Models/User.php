<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $table = "users";
    protected $fillable = [
        'user_id',
        'first_name',
        'mobile_number',
        'pin',
        'id_number',
        'gcm_id',
        'created_at',
        'updated_at',
        'sync_at',
        'email',
        'status',
        'activation_code',
        'user_type',
        'parent',
        'parent',
        'package',
        'package_date',
        'trail_used_flag',
        'from_source',
        'address',
        'county',
        'subcounty',
        'ward',
        'rapidvet',
        'has_user_group_training',
        'trainer_approved',
        'age',
        'gender',
        'terms_conditions'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
