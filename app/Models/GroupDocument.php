<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupDocument extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at',
        'groupId'
    ];

    protected $fillable = [
        'name',
        'url',
        'groupId'
    ];

    use HasFactory;
}
