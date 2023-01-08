<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_Tag extends Model
{
    use HasFactory;
    protected $table = 'product_tag';
    protected $timestamp = true;
    protected $fillable = [
        'product_id',
        'tag_id',
    ];
    use SoftDeletes;
}