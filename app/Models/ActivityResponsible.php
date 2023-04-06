<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityResponsible extends Model
{
    use HasFactory;

    protected $fillable = [
        'groupId',
        'memberId'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'groupId'
    ];
}
