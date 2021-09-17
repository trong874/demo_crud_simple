<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'parent_id',
        'sort_order'
    ];

    public function product()
    {
        return $this->hasMany(Product::class,'category_id');
    }

    public function category()
    {
        return $this->hasMany(Category::class,'parent_id','id')->orderBy('sort_order','ASC');
    }
}
