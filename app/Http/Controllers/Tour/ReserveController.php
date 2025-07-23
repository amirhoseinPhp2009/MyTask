<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\ReserveCancellingCountryIdRequest;
use App\Services\CancellingReservesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
{


    public function reserveCancellingByCountryId()
    {
        $response = DB::table('reserves')->select('reserves.id', 'reserves.user_id', 'reserves.status', 'reserves.cancelled_at', 'reserves.created_at')->
        join('users', 'reserves.user_id', '=', 'users.id')->
        where('users.country_id', 726)->where('reserves.cancelled_at', NULL)->
        orderBy('reserves.created_at', 'desc')->get()[0]->update(['status' => 'cancelled_by_user']);

//        $response = DB::table('reserves')-
        dd($response);
    }
}
