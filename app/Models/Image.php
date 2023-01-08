<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $timestamp = true;
    protected $fillable = [
        'name',
        'is_main_image',
        'product_id',
        'creatd_id',
        'updated_id',
    ];
    use SoftDeletes;
}