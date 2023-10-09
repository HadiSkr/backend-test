<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class customers extends Authenticatable
{
  use HasFactory, HasApiTokens;
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    protected $fillable = [
      'customer_id',
      'name',
      'city',
      'status',
      'phone',
      'email',
      'password',
	    'bank_name',
      'bank_number',
      'general_service',
      'specific_service',
      'image',
      'latitude',
      'longitude',
	];
}
