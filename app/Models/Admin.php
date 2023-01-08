<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $timestamp = true;
    protected $fillable = [
        'name',
        'password',
        'image',
        'email',
        'created_id',
        'updated_id',
    ];
    use SoftDeletes;
}