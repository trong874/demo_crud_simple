<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'price',
      'description',
      'category_id'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
