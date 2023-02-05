<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomerUser extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "customerusers";
    protected $guarded = [];
    protected $fillable = [
        'username',
        'birthdate',
        'password',
        'email',
        'mobile_number',
        'otp',
        'is_verified'
    ];
}
