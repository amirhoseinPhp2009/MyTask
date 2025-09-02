<?php

namespace App\Models;

use App\Traits\ModelCachable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
//    use ModelCachable;

    public $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    protected $hidden = [
        'cacheKey',
        'querySyntax',
        'bindings'
    ];
}
