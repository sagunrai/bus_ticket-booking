<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;


    public function busnameforpasger()
    {
        return $this->belongsTo(bus::class, 'bus_id', 'id');
    }



}
