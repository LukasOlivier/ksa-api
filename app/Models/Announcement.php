<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'date',
        'targetGroup',
        'creatorId'
    ];

    public function translations()
    {
        return $this->hasMany(AnnouncementTranslation::class, 'announcementId');
    }
    protected $appends = ['translations'];

    public function getTranslationsAttribute()
    {
        return $this->translations()->get();
    }


    use HasFactory;
}
