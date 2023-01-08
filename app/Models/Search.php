<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model
{
    use HasFactory;
    protected $table = 'searchs';
    protected $timestamp = true;
    protected $fillable = [
        'name',
        'user_id',
    ];
    use SoftDeletes;
}