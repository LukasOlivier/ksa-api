<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementTranslation extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at',
        'announcementId'
    ];

    protected $fillable = [
        'announcementId',
        'language',
        'title',
        'message',
    ];
}
