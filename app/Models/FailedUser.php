<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailedUser extends Model
{
    protected $table = 'failed_users';

    protected $fillable = [
        'uuid',
        'payload',
        'exception',
        'failed_at',
    ];

    public $timestamps = false;

}
