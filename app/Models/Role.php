<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $timestamp = true;
    protected $fillable = [
        'name',
        'admin_id',
        'created_id',
        'updated_id',
    ];
    use SoftDeletes;
}