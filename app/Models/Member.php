<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Member extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'nickName',
        'address',
        'phone',
        'email',
        'rank',
        'password',
        'profilePicture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'password',
        'pivot',
        'created_at',
        'updated_at',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
 * Get the identifier that will be stored in the subject claim of the JWT.
 */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /*
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_members', 'memberId', 'groupId');
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['groups'] = $this->groups->pluck('name');
        return $array;
    }
}
