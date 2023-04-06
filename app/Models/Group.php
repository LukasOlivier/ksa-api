<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    use HasFactory;

    public function members(){
        return $this->belongsToMany(Member::class, 'group_members', 'groupId', 'memberId');
    }
    public function documents(){
        return $this->hasMany(GroupDocument::class, 'groupId');
    }
    public function activityResponsibles(){
        return $this->belongsToMany(Member::class, 'activity_responsibles', 'groupId', 'memberId');
    }

    public function getMembersAttribute(){
        return $this->members()->get();
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'groupId');
    }

    public function getEventsAttribute(){
        return $this->events()->get();
    }

    public function getDocumentsAttribute(){
        return $this->documents()->get();
    }
    public function getActivityResponsiblesAttribute(){
        return $this->activityResponsibles()->get();
    }
    protected $appends = ['members', 'documents', 'activityResponsibles', 'events'];

}
