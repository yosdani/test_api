<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client';

    /**
     * The attributes that are mass assignable.
     *
     * @var string
     */
    protected $fillable = [
        'name','ci',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @return  HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'client_id');
    }
    public function registers(): HasMany
    {
        return $this->hasMany(RegisterClient::class, 'client_id');
    }

}
