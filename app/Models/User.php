<?php

namespace App\Models;

use App\Notifications\SendVerifyWithQueueNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable #implements MustVerifyEmail     # test of email verification
{
    use HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }

    public function hasRole($roles){
        $userRoles = $this->roles()->pluck('name')->toArray();
        foreach ($roles as $role) {
            if (in_array($role, $userRoles)) {
                return true;
            }
        }
        return false;
    }

    public function sendEmailVerificationNotification(){
        $this->notify(new SendVerifyWithQueueNotification());
    }

    public function likedPosts(){
        return $this->belongsToMany(Post::class, 'post_user_likes', 'user_id', 'post_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
