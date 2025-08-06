<?php /** @noinspection ALL */

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\UserRequest;
use App\Models\User;
use App\Repositories\Project\UserRepository;
use Illuminate\Database\Query\Builder;

class BaseController extends Controller
{
    public function index()
    {
//        $data = [
//            'first_name' => 'am',
//            'last_name' => 'm',
//            'phone' => '0123456789',
//            'email' => 'jddfa@gmail.com'
//        ];


        $users = User::where('id', '=', 1)->where('first_name', '=','amirh')->get();

        dd($users);
    }
}
