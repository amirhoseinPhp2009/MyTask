<?php

namespace App\Models;

use App\Traits\ModelCachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, ModelCachable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'country_id',
        'first_name',
        'last_name',
        'phone',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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


//    static function booted(): void
//    {
//        static::saving(function ($model) {
//            return Cache::clear();
//        });
//
//        static::deleting(function ($model) {
//            return Cache::clear();
//        });
//
//        static::deleting(function ($model) {
//            return Cache::clear();
//        });
//
//    }
//
//    public
//    function newEloquentBuilder($query): UserBuilder
//    {
//        return new UserBuilder($query);
//    }

}
