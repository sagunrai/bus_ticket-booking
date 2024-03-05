<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusShadule extends Model
{
    use HasFactory;

    protected $fillable = ['date','bus_id'];

    public function buses(){
        return $this->belongsTo(bus::class, 'bus_id');
    }
}
