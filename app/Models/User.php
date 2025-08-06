<?php

namespace App\Models;

use App\Models\Builders\UserBuilder;
use App\ModelScopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
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


//    protected static function booted(): void
//    {
//        static::saving(function ($model) {
//            $query = $model->toSql();
//            $result = $model->attributes;
//
////            Cache::put('arr', $result);
//            dd(Cache::get('arr'));
//        });
//
//        static::deleting(function ($model) {
//            dd('deleting');
//        });
//
//        static::deleting(function ($model) {
//            dd('deleting');
//        });
//
//        static::retrieved(function ($model) {
//            $attr = $model->toSql();
////            $str = $attr['id'] . $attr['email'] . $attr['phone'];
////            $hash = Hash::make($str);
//            $emo = $model->getBindings();
////            dd($model->toSql());
//        });


//    }

public function newEloquentBuilder($query): UserBuilder
{
    return new UserBuilder($query);
}

}
