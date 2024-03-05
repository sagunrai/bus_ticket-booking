<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;


   public function busname()
   {
       return $this->belongsTo(bus::class, 'bus_id', 'id');
   }


}
