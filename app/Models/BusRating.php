<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRating extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id','rating','review'];

    public function busname(){
        return $this->belongsTo(bus::class,'bus_id','id');
    }
}
