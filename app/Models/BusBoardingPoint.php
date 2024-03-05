<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusBoardingPoint extends Model
{
    use HasFactory;
    protected $fillable = ['time','point_type','point','bus_id'];

    /**
     * Get the bus that owns the BusBoardingPoint
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bus(): BelongsTo
    {
        return $this->belongsTo(bus::class,'bus_id','id');
    }

}
