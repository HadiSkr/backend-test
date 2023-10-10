<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\customers;


class SpecificService extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'service_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function customers()
    {
        return $this->hasMany(customers::class);
    }
}
