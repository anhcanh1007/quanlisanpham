<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $timestamp = true;
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'category_id',
        'created_id',
        'updated_id',
    ];
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }
}