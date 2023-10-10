<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SpecificService;
use App\Models\customers;


class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function specificServices()
    {
        return $this->hasMany(SpecificService::class);
    }

    public function customers()
    {
        return $this->hasMany(customers::class);
    }
}
