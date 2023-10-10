<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class customers extends Authenticatable
{
  use HasFactory, HasApiTokens, Notifiable;
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
        'image',
        'latitude',
        'longitude',
        'service_id',
        'specific_service_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function specificService()
    {
        return $this->belongsTo(SpecificService::class);
    }
}
