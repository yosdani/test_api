<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterClient extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_register';

    /**
     * The attributes that are mass assignable.
     *
     * @var string
     */
    protected $fillable = [
        'vehicle_id','client_id','date','start_time','end_time','total_time','amount'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(RegisterClient::class, 'vehicle_id');
    }

    public function client()
    {
        return $this->belongsTo(RegisterClient::class, 'client_id');
    }
}
