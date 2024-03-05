<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Get the category that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class,'subparent_id','id');
    }


    public function sub_category()
    {

        return $this->hasMany(Category::class,'parent_id','id');
    }
    // seperate category and sub category
    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_categories', 'category_id', 'post_id');
    }

}
