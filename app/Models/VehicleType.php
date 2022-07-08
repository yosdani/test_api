<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleType extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vehicle_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var string
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @return  HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'vehicle_type_id');
    }
}
