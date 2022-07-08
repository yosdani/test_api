<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vehicle';

    /**
     * The attributes that are mass assignable.
     *
     * @var string
     */
    protected $fillable = [
        'enrollment','color','client_id','vehicle_type_id',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicleType()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_type_id');
    }

    public function client()
    {
        return $this->belongsTo(Vehicle::class, 'client_id');
    }
    public function registers(): HasMany
    {
        return $this->hasMany(RegisterClient::class, 'vehicle_id');
    }
}
