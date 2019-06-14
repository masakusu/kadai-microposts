<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Micropost::class, 'favorites', 'user_id', 'micropost_id')->withTimestamps();
    }
    
    public function favorite($micropostId)
    {
        
        $exist = $this->is_favorites($micropostId);
    
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($micropostId);
            return true;
        }
    }
    
    public function unfavorite($micropostId)
    {
        $exist = $this->is_favorites($micropostId);
    
        if ($exist) {
            $this->favorites()->detach($micropostId);
            return true;
        } else {
            return false;
        }
    }
    
    public function is_favorites($micropostId)
    {
        return $this->favorites()->where('micropost_id', $micropostId)->exists();
    }
    
    public function feed_microposts()
    {
        $favorite_micropost_ids = $this->favorites()->pluck('microposts.id')->toArray();
        return Micropost::whereIn('user_id', $favorite_micropost_ids);
    }
}
