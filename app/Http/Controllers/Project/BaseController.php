<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\User;

class BaseController extends Controller
{
    public function index()
    {

        $data = [
            'first_name' => 'amirhosein',
            'lastname' => 'babaei',
            'phone' => '09399008730',
            'email' => 'amirhb@gmail.com',

        ];

        $dd = User::where('id', 15)->first()->update($data);
        dd($dd);
    }

}
