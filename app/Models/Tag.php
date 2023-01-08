<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $timestamp = true;
    protected $fillable = [
        'name',
        'color',
        'created_id',
        'updated_id',
    ];
    use SoftDeletes;
}