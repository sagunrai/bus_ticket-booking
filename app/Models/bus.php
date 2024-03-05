<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class bus extends Model
{
    use HasFactory;

    public function bustypename()
    {
        return $this->belongsTo(bustype::class,'bustype','id');
    }

    public function busroutename()
    {
        return $this->belongsTo(Category::class,'busroute','id');
    }

    /**
     * Get all of the shadules for the bus
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shadules(): HasMany
    {
        return $this->hasMany(BusShadule::class,'bus_id','id');
    }

    /**
     * Get all of the bookings for the bus
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class,'bus_id','id');
    }

    /**
     * Get all of the points for the bus
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points(): HasMany
    {
        return $this->hasMany(BusBoardingPoint::class,'bus_id','id');
    }

    /**
     * Get all of the gallery for the bus
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(Gallery::class,'bus_id','id');
    }

    /**
     * Get all of the ratings for the bus
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(BusRating::class,'bus_id','id');
    }

    /**
     * The operators that belong to the bus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function operators(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'bus_operators', 'bus_id', 'user_id');
    }
}
