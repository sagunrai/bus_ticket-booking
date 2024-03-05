<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    /**
    * The courses that belong to the College
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function category()
   {
       return $this->belongsToMany(Category::class,'subcategory_cateogry','subcategory_id','category_id');
   }
}
